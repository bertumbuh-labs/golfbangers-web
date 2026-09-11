<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GolfBangers.com Live Score</title>
  <?php include dirname(__DIR__) . '/inc/pwa-head.php'; ?>
  <link rel="preconnect" href="https://images.unsplash.com">
  <style>
    :root {
      --green: #126348;
      --green-2: #0d4c38;
      --ink: #162018;
      --muted: #617061;
      --line: #d9dfd4;
      --soft: #eef6ee;
      --gold: #f4c95d;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      min-height: 100dvh;
      font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
      background: #eef3ec;
      color: var(--ink);
    }
    .hero {
      min-height: 100dvh;
      display: grid;
      grid-template-rows: 1fr auto;
      align-items: stretch;
      padding: 18px;
      padding-bottom: max(18px, env(safe-area-inset-bottom));
      background:
        linear-gradient(180deg, rgba(9, 25, 18, .20), rgba(9, 25, 18, .72)),
        url("https://images.unsplash.com/photo-1535131749006-b7f58c99034b?auto=format&fit=crop&w=1200&q=55") center / cover;
    }
    .wrap {
      width: min(760px, 100%);
      margin: 0 auto;
      align-self: end;
      display: grid;
      gap: 14px;
      padding-bottom: 10px;
    }
    .brand {
      position: relative;
      color: #fff;
      text-shadow: 0 2px 14px rgba(0,0,0,.35);
      padding-top: 48px;
    }
    .brand small {
      position: absolute;
      top: 0;
      right: 0;
      display: inline-flex;
      padding: 6px 10px;
      border-radius: 999px;
      background: rgba(255,255,255,.18);
      border: 1px solid rgba(255,255,255,.28);
      font-weight: 800;
      backdrop-filter: blur(8px);
      white-space: nowrap;
    }
    h1 {
      margin: 12px 0 6px;
      font-size: clamp(34px, 9vw, 58px);
      line-height: .96;
      letter-spacing: 0;
      overflow-wrap: anywhere;
    }
    .subtitle {
      margin: 0;
      color: #fff;
      font-size: clamp(24px, 7vw, 42px);
      font-weight: 900;
      line-height: 1;
    }
    .lead {
      margin: 0;
      max-width: 640px;
      color: rgba(255,255,255,.90);
      font-size: 16px;
      line-height: 1.45;
    }
    .panel {
      display: grid;
      gap: 12px;
      padding: 14px;
      border: 1px solid rgba(255,255,255,.55);
      border-radius: 8px;
      background: rgba(255,255,255,.96);
      box-shadow: 0 18px 48px rgba(0,0,0,.24);
    }
    .panel.created .create-form { display: none; }
    label {
      display: grid;
      gap: 6px;
      font-size: 13px;
      font-weight: 800;
      color: #314034;
    }
    input, button {
      width: 100%;
      min-height: 50px;
      border: 1px solid var(--line);
      border-radius: 8px;
      padding: 11px 12px;
      font: inherit;
    }
    input {
      background: #fbfff8;
      font-size: 16px;
    }
    input[readonly] {
      color: #314034;
      background: #f2f7ef;
      font-weight: 850;
    }
    input:focus {
      outline: 3px solid rgba(18, 99, 72, .16);
      border-color: #86bca4;
      background: #f4fbf6;
    }
    button {
      border-color: var(--green);
      background: var(--green);
      color: #fff;
      font-weight: 900;
      cursor: pointer;
      box-shadow: 0 8px 18px rgba(18,99,72,.22);
    }
    button:active { transform: translateY(1px); }
    .fine {
      margin: 0;
      color: var(--muted);
      font-size: 12px;
      line-height: 1.4;
    }
    .links {
      display: grid;
      gap: 9px;
      word-break: break-word;
    }
    .link-card {
      display: grid;
      gap: 5px;
      padding: 10px;
      border: 1px solid var(--line);
      border-radius: 8px;
      background: var(--soft);
    }
    .link-card.primary-link {
      border-color: #8bc1a8;
      background: #e8f6ed;
    }
    .link-card b { color: var(--green-2); }
    a {
      color: var(--green-2);
      font-weight: 800;
      text-decoration-thickness: 2px;
      text-underline-offset: 3px;
    }
    .action-link {
      display: grid;
      place-items: center;
      min-height: 46px;
      margin-top: 8px;
      border-radius: 8px;
      background: var(--green);
      color: #fff;
      text-decoration: none;
      box-shadow: 0 8px 18px rgba(18,99,72,.18);
    }
    .share-link {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      min-height: 40px;
      margin-top: 4px;
      padding: 8px 10px;
      border: 1px solid #9dd5b4;
      border-radius: 8px;
      background: #f7fff8;
      text-decoration: none;
    }
    .cta-secondary {
      display: grid;
      place-items: center;
      min-height: 48px;
      border: 1px solid rgba(255,255,255,.45);
      border-radius: 10px;
      background: rgba(255,255,255,.16);
      color: #fff;
      font-weight: 900;
      font-size: 15px;
      text-decoration: none;
      text-shadow: 0 1px 8px rgba(0,0,0,.28);
      backdrop-filter: blur(8px);
      box-shadow: 0 8px 20px rgba(0,0,0,.12);
    }
    .cta-secondary:active { transform: translateY(1px); }
    .tiny-link {
      justify-self: center;
      color: rgba(255,255,255,.88);
      font-size: 12px;
      font-weight: 800;
      text-shadow: 0 1px 8px rgba(0,0,0,.35);
    }
    .tiny-link button {
      width: auto;
      min-height: auto;
      padding: 0;
      border: 0;
      border-radius: 0;
      background: transparent;
      box-shadow: none;
      color: inherit;
      text-decoration: underline;
      text-decoration-thickness: 2px;
      text-underline-offset: 3px;
      font-size: 12px;
      font-weight: 900;
    }
    .monitor-panel {
      display: none;
      gap: 10px;
      padding: 12px;
      border: 1px solid rgba(255,255,255,.55);
      border-radius: 8px;
      background: rgba(255,255,255,.96);
    }
    .monitor-panel.show { display: grid; }
    .site-footer {
      width: min(760px, 100%);
      margin: 0 auto;
      padding: 14px 8px 4px;
      color: rgba(255,255,255,.78);
      text-align: center;
      font-size: 12px;
      line-height: 1.45;
      text-shadow: 0 1px 8px rgba(0,0,0,.35);
    }
    .site-footer .app-version {
      display: inline-block;
      margin-top: 6px;
      padding: 3px 9px;
      border-radius: 999px;
      border: 1px solid rgba(255,255,255,.28);
      background: rgba(255,255,255,.14);
      color: #fff;
      font-size: 11px;
      font-weight: 800;
      letter-spacing: .03em;
    }
    @media (max-width: 560px) {
      .hero {
        min-height: 100dvh;
        padding: 12px;
        padding-top: max(12px, env(safe-area-inset-top));
        padding-bottom: max(12px, env(safe-area-inset-bottom));
      }
      .wrap {
        width: 100%;
        gap: 12px;
        align-self: end;
      }
      .brand {
        padding-top: 0;
        display: grid;
        gap: 4px;
      }
      .brand small {
        position: static;
        justify-self: start;
        margin-bottom: 4px;
        font-size: 11px;
        padding: 5px 9px;
      }
      h1 {
        margin: 0;
        font-size: clamp(28px, 8vw, 40px);
        line-height: 1.05;
      }
      .subtitle {
        font-size: clamp(18px, 5.2vw, 26px);
        font-weight: 800;
      }
      .panel, .monitor-panel {
        padding: 12px;
        border-radius: 10px;
      }
      input, button, .action-link { min-height: 48px; }
      .link-card { padding: 12px; gap: 6px; }
      .link-card a:not(.action-link):not(.share-link) {
        display: block;
        font-size: 13px;
        line-height: 1.35;
        word-break: break-all;
      }
      .tiny-link { font-size: 12px; text-align: center; }
      .site-footer {
        width: 100%;
        font-size: 11px;
        line-height: 1.4;
        padding: 12px 4px 2px;
      }
      .site-footer .app-version { font-size: 10px; margin-top: 5px; }
    }
    @media (max-width: 380px) {
      h1 { font-size: 26px; }
      .subtitle { font-size: 17px; }
    }
  </style>
</head>
<body>
  <main class="hero">
    <div class="wrap">
      <section class="brand">
        <small id="today"></small>
        <h1>GolfBangers.com!</h1>
        <p class="subtitle">Live Score</p>
      </section>

      <section class="panel" aria-label="Buat game live">
        <div id="createForm" class="create-form">
          <label>Nama game otomatis
            <input id="titlePreview" value="Go Bangers!" readonly>
          </label>
          <label>Password admin
            <input id="token" placeholder="Minimal 4 digit untuk edit score" autocomplete="new-password">
          </label>
          <button id="create">Buat Game Live</button>
          <p class="fine">Setelah game dibuat, simpan link admin untuk scorer. Link view-only bisa dibagikan ke pemain lain.</p>
        </div>
        <div id="result" class="links"></div>
      </section>

      <a class="cta-secondary" href="https://golfbangers.com/download/">Install App</a>

      <div class="tiny-link">
        Master admin? <button id="toggleMonitor" type="button">Monitor game hari ini</button>
      </div>

      <section id="monitorPanel" class="monitor-panel" aria-label="Monitor game hari ini">
        <label>Viewer password
          <input id="viewerKey" type="password" placeholder="Password viewer" autocomplete="current-password">
        </label>
        <button id="loadGames" type="button">Lihat Game Hari Ini</button>
        <p class="fine">Link yang muncul hanya view-only. Aman buat pantau tanpa ikut merusak mood scorer.</p>
        <div id="games" class="links"></div>
      </section>
    </div>

    <footer class="site-footer">
      <div>Copyright &copy; 2026 GolfBangers.com by Emon. All Rights Reserved.</div>
      <span class="app-version">Live Score v1.2.0</span>
    </footer>
  </main>

<script>
const now = new Date();
const dateText = new Intl.DateTimeFormat("id-ID", { day: "2-digit", month: "2-digit", year: "numeric" }).format(now);
const dayText = new Intl.DateTimeFormat("en-US", { weekday: "short" }).format(now);
document.getElementById("today").textContent = `${dayText}, ${dateText}`;
document.getElementById("token").focus();
async function loadNextTitle() {
  try {
    const res = await fetch("api.php?action=next_title", { cache: "no-store" });
    const data = await res.json();
    document.getElementById("titlePreview").value = data.ok ? data.title : `Go Bangers! (${dayText}, ${dateText}) #001`;
  } catch {
    document.getElementById("titlePreview").value = `Go Bangers! (${dayText}, ${dateText}) #001`;
  }
}
loadNextTitle();
function basePath() {
  return location.origin + location.pathname.replace(/index\.php$/, "");
}
document.getElementById("create").addEventListener("click", async () => {
  const result = document.getElementById("result");
  const token = document.getElementById("token").value.trim();
  if (token.length < 4) {
    result.innerHTML = `<div class="link-card"><b>Password admin minimal 4 digit.</b></div>`;
    return;
  }
  result.innerHTML = `<div class="link-card"><b>Membuat game...</b></div>`;
  const res = await fetch("api.php?action=create", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      token
    })
  });
  const data = await res.json();
  if (!data.ok) {
    result.innerHTML = `<div class="link-card"><b>${data.error || "Gagal membuat game."}</b></div>`;
    return;
  }
  const adminUrl = basePath() + data.edit_url;
  const viewUrl = basePath() + data.view_url;
  const whatsAppText = encodeURIComponent(`Live score GolfBangers:\n${viewUrl}`);
  document.querySelector(".panel").classList.add("created");
  result.innerHTML = `
    <div class="link-card primary-link">
      <b>${data.title || "Go Bangers!"}</b>
      <span>Game ID: ${data.id}</span>
      <span>Scorer/admin lanjut dari tombol ini.</span>
      <a class="action-link" href="${data.edit_url}">Mulai Disini</a>
    </div>
    <div class="link-card">
      <b>View-only link</b>
      <span>Bagikan ke player lain untuk pantau live score.</span>
      <a href="${data.view_url}">${viewUrl}</a>
      <a class="share-link" target="_blank" rel="noopener" href="https://wa.me/?text=${whatsAppText}">Share to WhatsApp</a>
    </div>
  `;
  loadNextTitle();
});
document.getElementById("toggleMonitor").addEventListener("click", () => {
  document.getElementById("monitorPanel").classList.toggle("show");
});
document.getElementById("loadGames").addEventListener("click", async () => {
  const box = document.getElementById("games");
  const key = document.getElementById("viewerKey").value;
  box.innerHTML = `<div class="link-card"><b>Memuat game hari ini...</b></div>`;
  const res = await fetch(`api.php?action=list&viewer_key=${encodeURIComponent(key)}`, { cache: "no-store" });
  const data = await res.json();
  if (!data.ok) {
    box.innerHTML = `<div class="link-card"><b>${data.error || "Gagal memuat list game."}</b></div>`;
    return;
  }
  if (!data.games.length) {
    box.innerHTML = `<div class="link-card"><b>Belum ada game hari ini.</b></div>`;
    return;
  }
  box.innerHTML = data.games.map(game => `
    <div class="link-card">
      <b>${game.title} - ${game.id}</b>
      <span>Update terakhir: ${game.updated_at}${game.expired ? " | Expired" : ""}${game.locked ? " | Locked" : ""}</span>
      <a href="${game.view_url}">${basePath() + game.view_url}</a>
    </div>
  `).join("");
});
</script>
</body>
</html>
