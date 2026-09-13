<?php
/**
 * Footer bersama.
 *
 * Opsional sebelum include:
 *   $footer_version_label  — override teks versi
 *   $footer_wrap_inner     — true = bungkus dengan .footer-inner (halaman game)
 */
$appMeta = require __DIR__ . '/app-meta.php';
$footerVersion = $footer_version_label ?? ($appMeta['version_label'] ?? 'Live Score');
$footerCopyright = $appMeta['copyright'] ?? 'Copyright © GolfBangers.com';
$wrapInner = !empty($footer_wrap_inner);
?>
<footer class="site-footer">
<?php if ($wrapInner): ?>
  <div class="footer-inner">
<?php endif; ?>
    <div><?= htmlspecialchars($footerCopyright, ENT_QUOTES, 'UTF-8') ?></div>
    <span class="app-version"><?= htmlspecialchars($footerVersion, ENT_QUOTES, 'UTF-8') ?></span>
<?php if ($wrapInner): ?>
  </div>
<?php endif; ?>
</footer>
<?php
unset($footer_version_label, $footer_wrap_inner, $footerVersion, $footerCopyright, $wrapInner, $appMeta);
