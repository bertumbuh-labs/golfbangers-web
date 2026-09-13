<?php
header('Content-Type: application/json; charset=utf-8');
date_default_timezone_set('Asia/Jakarta');

function respond($data, int $status = 200): void {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

function config(): array {
    $file = __DIR__ . '/config.php';
    if (!file_exists($file)) {
        respond(['ok' => false, 'error' => 'config.php belum ada. Copy config.sample.php menjadi config.php lalu isi data MySQL.'], 500);
    }
    return require $file;
}

function pdo(): PDO {
    $c = config();
    $dsn = 'mysql:host=' . $c['db_host'] . ';dbname=' . $c['db_name'] . ';charset=utf8mb4';
    return new PDO($dsn, $c['db_user'], $c['db_pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}

function body(): array {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw ?: '{}', true);
    return is_array($data) ? $data : [];
}

function gameId(): string {
    return 'BG' . date('ymd') . strtoupper(bin2hex(random_bytes(3)));
}

function defaultState(): string {
    return json_encode([
        'started' => false,
        'gameDate' => date('Y-m-d'),
        'players' => ['', '', '', ''],
        'front' => 'valley',
        'back' => 'lake',
        'active' => 0,
        'startBanker' => 0,
        'useBacarat' => true,
        'rates' => ['f2f' => 100000, 'winner' => 100000, 'par3Bonus' => 100000, 'bacarat' => 50000, 'bacaratPar3' => 100000],
        'voor' => new stdClass(),
        'voorAdjustments' => new stdClass(),
        'editingVoorStart' => 0,
        'activeFrom' => new stdClass(),
        'inactiveFrom' => new stdClass(),
        'editingSetup' => false,
        'showNineSummary' => false,
        'showFinalSummary' => false,
        'holes' => [],
    ], JSON_UNESCAPED_SLASHES);
}

function voorCount(array $state): int {
    $count = 0;
    foreach (($state['voor'] ?? []) as $value) {
        if (trim((string)$value) !== '') $count++;
    }
    foreach (($state['voorAdjustments'] ?? []) as $voor) {
        if (!is_array($voor)) continue;
        foreach ($voor as $value) {
            if (trim((string)$value) !== '') $count++;
        }
    }
    return $count;
}

function mergeVoor($existingVoor, $incomingVoor): array {
    $merged = is_array($existingVoor) ? $existingVoor : [];
    if (!is_array($incomingVoor)) return $merged;
    foreach ($incomingVoor as $key => $value) {
        $clean = trim((string)$value);
        if ($clean !== '') $merged[$key] = $value;
    }
    return $merged;
}

function mergeVoorAdjustments($existingAdjustments, $incomingAdjustments): array {
    $merged = is_array($existingAdjustments) ? $existingAdjustments : [];
    if (!is_array($incomingAdjustments)) return $merged;
    foreach ($incomingAdjustments as $start => $voor) {
        $merged[$start] = mergeVoor($merged[$start] ?? [], $voor);
    }
    return $merged;
}

function sendGameCreatedNotification(array $config, string $id, string $title, string $editUrl, string $viewUrl): void {
    $to = trim($config['notify_email'] ?? '');
    if (!$to || !filter_var($to, FILTER_VALIDATE_EMAIL)) return;

    $siteUrl = rtrim($config['site_url'] ?? '', '/');
    $edit = $siteUrl ? $siteUrl . '/' . ltrim($editUrl, '/') : $editUrl;
    $view = $siteUrl ? $siteUrl . '/' . ltrim($viewUrl, '/') : $viewUrl;
    $subject = 'GolfBangers.com - Game baru dibuat';
    $message = "Game baru dibuat di GolfBangers.com\n\n"
        . "Game ID: {$id}\n"
        . "Nama Game: {$title}\n"
        . "Admin/Edit: {$edit}\n"
        . "View-only: {$view}\n"
        . "Waktu server: " . date('Y-m-d H:i:s') . "\n";
    $headers = "From: GolfBangers.com <no-reply@golfbangers.com>\r\n";
    @mail($to, $subject, $message, $headers);
}

function autoGameTitle(PDO $db): string {
    $dateText = date('d/m/Y');
    $countStmt = $db->prepare('SELECT COUNT(*) FROM games WHERE title LIKE ?');
    $countStmt->execute(['Go Bangers! (%, ' . $dateText . ') #%']);
    $sequence = ((int)$countStmt->fetchColumn()) + 1;
    return sprintf('Go Bangers! (%s, %s) #%03d', date('D'), $dateText, $sequence);
}

function cleanupExpiredGames(PDO $db): void {
    $db->exec('DELETE FROM games WHERE expires_at < NOW()');
}

function canEditGame(string $token, array $game, string $superAdminKey): bool {
    if ($token === '') return false;
    if ($superAdminKey !== '' && hash_equals($superAdminKey, $token)) return true;
    return password_verify($token, $game['edit_token_hash']);
}

$action = $_GET['action'] ?? '';
$viewerKey = '1234';
$superAdminKey = '5678';

try {
    $db = pdo();
    cleanupExpiredGames($db);

    if ($action === 'next_title') {
        respond(['ok' => true, 'title' => autoGameTitle($db)]);
    }

    if ($action === 'list') {
        $key = trim($_GET['viewer_key'] ?? '');
        $isViewer = hash_equals($viewerKey, $key);
        $isSuperAdmin = hash_equals($superAdminKey, $key);
        if (!$isViewer && !$isSuperAdmin) {
            respond(['ok' => false, 'error' => 'Password viewer/admin salah.'], 403);
        }
        $stmt = $db->query("SELECT id, title, created_at, updated_at, expires_at, locked FROM games WHERE DATE(created_at) = CURDATE() ORDER BY updated_at DESC");
        $games = array_map(function ($game) use ($isSuperAdmin, $superAdminKey) {
            $item = [
                'id' => $game['id'],
                'title' => $game['title'],
                'created_at' => $game['created_at'],
                'updated_at' => $game['updated_at'],
                'expired' => strtotime($game['expires_at']) < time(),
                'locked' => (bool)$game['locked'],
                'view_url' => 'game.php?id=' . urlencode($game['id']),
            ];
            if ($isSuperAdmin) {
                $item['edit_url'] = 'game.php?id=' . urlencode($game['id']) . '&edit=' . urlencode($superAdminKey);
            }
            return $item;
        }, $stmt->fetchAll());
        respond(['ok' => true, 'mode' => $isSuperAdmin ? 'admin' : 'view', 'games' => $games]);
    }

    if ($action === 'create') {
        $config = config();
        $data = body();
        $title = autoGameTitle($db);
        $token = trim($data['token'] ?? '');
        if (strlen($token) < 4) respond(['ok' => false, 'error' => 'Admin key minimal 4 karakter.'], 422);

        $id = gameId();
        $stmt = $db->prepare('INSERT INTO games (id, title, edit_token_hash, state_json, expires_at) VALUES (?, ?, ?, ?, DATE_ADD(NOW(), INTERVAL 3 DAY))');
        $stmt->execute([$id, $title, password_hash($token, PASSWORD_DEFAULT), defaultState()]);
        $viewUrl = 'game.php?id=' . urlencode($id);
        $editUrl = 'game.php?id=' . urlencode($id) . '&edit=' . urlencode($token);
        sendGameCreatedNotification($config, $id, $title, $editUrl, $viewUrl);
        respond([
            'ok' => true,
            'id' => $id,
            'title' => $title,
            'view_url' => $viewUrl,
            'edit_url' => $editUrl,
        ]);
    }

    $id = preg_replace('/[^A-Za-z0-9]/', '', $_GET['id'] ?? '');
    if (!$id) respond(['ok' => false, 'error' => 'Game ID kosong.'], 400);

    $stmt = $db->prepare('SELECT * FROM games WHERE id = ?');
    $stmt->execute([$id]);
    $game = $stmt->fetch();
    if (!$game) respond(['ok' => false, 'error' => 'Game tidak ditemukan.'], 404);

    if ($action === 'get') {
        respond([
            'ok' => true,
            'id' => $game['id'],
            'title' => $game['title'],
            'locked' => (bool)$game['locked'],
            'expired' => strtotime($game['expires_at']) < time(),
            'updated_at' => $game['updated_at'],
            'state' => json_decode($game['state_json'], true),
        ]);
    }

    if ($action === 'update') {
        $data = body();
        $token = trim($data['token'] ?? '');
        if (!canEditGame($token, $game, $superAdminKey)) {
            respond(['ok' => false, 'error' => 'Admin key salah.'], 403);
        }
        if ((bool)$game['locked'] || strtotime($game['expires_at']) < time()) {
            respond(['ok' => false, 'error' => 'Game sudah locked/expired.'], 423);
        }
        $state = $data['state'] ?? null;
        if (!is_array($state)) respond(['ok' => false, 'error' => 'State tidak valid.'], 422);
        $existingState = json_decode($game['state_json'], true);
        if (is_array($existingState)) {
            $state['voor'] = mergeVoor($existingState['voor'] ?? [], $state['voor'] ?? []);
            $state['voorAdjustments'] = mergeVoorAdjustments($existingState['voorAdjustments'] ?? [], $state['voorAdjustments'] ?? []);
        }
        if (is_array($existingState) && (!array_key_exists('activeFrom', $state) || empty($state['activeFrom'])) && !empty($existingState['activeFrom'])) {
            $state['activeFrom'] = $existingState['activeFrom'];
        }
        $json = json_encode($state, JSON_UNESCAPED_SLASHES);
        $stmt = $db->prepare('UPDATE games SET state_json = ?, updated_at = NOW() WHERE id = ?');
        $stmt->execute([$json, $id]);
        $db->prepare('INSERT INTO game_audit_logs (game_id, action) VALUES (?, ?)')->execute([$id, 'update']);
        respond(['ok' => true, 'updated_at' => date('Y-m-d H:i:s'), 'voor_count' => voorCount($state)]);
    }

    if ($action === 'update_setup') {
        $data = body();
        $token = trim($data['token'] ?? '');
        if (!canEditGame($token, $game, $superAdminKey)) {
            respond(['ok' => false, 'error' => 'Admin key salah.'], 403);
        }
        if ((bool)$game['locked'] || strtotime($game['expires_at']) < time()) {
            respond(['ok' => false, 'error' => 'Game sudah locked/expired.'], 423);
        }
        $existingState = json_decode($game['state_json'], true);
        if (!is_array($existingState)) $existingState = [];
        if (array_key_exists('voor', $data)) {
            $data['voor'] = mergeVoor($existingState['voor'] ?? [], $data['voor']);
        }
        if (array_key_exists('voorAdjustments', $data)) {
            $data['voorAdjustments'] = mergeVoorAdjustments($existingState['voorAdjustments'] ?? [], $data['voorAdjustments']);
        }
        foreach (['players', 'voor', 'voorAdjustments', 'rates', 'startBanker', 'useBacarat', 'activeFrom', 'inactiveFrom'] as $key) {
            if (array_key_exists($key, $data)) $existingState[$key] = $data[$key];
        }
        $json = json_encode($existingState, JSON_UNESCAPED_SLASHES);
        $stmt = $db->prepare('UPDATE games SET state_json = ?, updated_at = NOW() WHERE id = ?');
        $stmt->execute([$json, $id]);
        $db->prepare('INSERT INTO game_audit_logs (game_id, action) VALUES (?, ?)')->execute([$id, 'update_setup']);
        respond(['ok' => true, 'updated_at' => date('Y-m-d H:i:s'), 'voor_count' => voorCount($existingState)]);
    }

    respond(['ok' => false, 'error' => 'Action tidak dikenal.'], 400);
} catch (Throwable $e) {
    respond(['ok' => false, 'error' => $e->getMessage()], 500);
}
