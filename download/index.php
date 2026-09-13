<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Install App · GolfBangers.com</title>
  <meta name="description" content="Install GolfBangers Live Score as an app on your phone or desktop.">
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
      padding: 18px;
      padding-bottom: max(18px, env(safe-area-inset-bottom));
      background:
        linear-gradient(180deg, rgba(9, 25, 18, .22), rgba(9, 25, 18, .78)),
        url("https://images.unsplash.com/photo-1535131749006-b7f58c99034b?auto=format&fit=crop&w=1400&q=55") center / cover;
    }
    .wrap {
      width: min(640px, 100%);
      margin: 0 auto;
      align-self: end;
      display: grid;
      gap: 14px;
      padding-bottom: 10px;
    }
    .brand {
      color: #fff;
      text-shadow: 0 2px 14px rgba(0,0,0,.35);
    }
    .brand small {
      display: inline-flex;
      padding: 6px 10px;
      border-radius: 999px;
      background: rgba(255,255,255,.18);
      border: 1px solid rgba(255,255,255,.28);
      font-weight: 800;
      backdrop-filter: blur(8px);
      margin-bottom: 10px;
    }
    h1 {
      margin: 0 0 6px;
      font-size: clamp(32px, 8vw, 52px);
      line-height: 1.02;
      overflow-wrap: anywhere;
    }
    .subtitle {
      margin: 0;
      color: #fff;
      font-size: clamp(20px, 5.5vw, 34px);
      font-weight: 900;
      line-height: 1.1;
    }
    .lead {
      margin: 8px 0 0;
      max-width: 38ch;
      color: rgba(255,255,255,.9);
      font-size: 15px;
      line-height: 1.45;
    }
    .panel {
      display: grid;
      gap: 14px;
      padding: 16px;
      border: 1px solid rgba(255,255,255,.55);
      border-radius: 12px;
      background: rgba(255,255,255,.96);
      box-shadow: 0 18px 48px rgba(0,0,0,.24);
    }
    .app-row {
      display: grid;
      grid-template-columns: 64px 1fr;
      gap: 12px;
      align-items: center;
    }
    .app-icon {
      width: 64px;
      height: 64px;
      border-radius: 14px;
      object-fit: cover;
      box-shadow: 0 8px 18px rgba(18,99,72,.22);
      background: var(--green);
    }
    .app-meta strong {
      display: block;
      font-size: 17px;
      color: var(--green-2);
    }
    .app-meta span {
      display: block;
      margin-top: 3px;
      color: var(--muted);
      font-size: 13px;
      line-height: 1.4;
    }
    .stats {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 8px;
    }
    .stat {
      padding: 10px 12px;
      border: 1px solid var(--line);
      border-radius: 8px;
      background: var(--soft);
    }
    .stat span {
      display: block;
      color: var(--muted);
      font-size: 11px;
      font-weight: 800;
      letter-spacing: .04em;
      text-transform: uppercase;
    }
    .stat b {
      display: block;
      margin-top: 3px;
      font-size: 15px;
      color: var(--ink);
    }
    .install-btn,
    .open-btn {
      display: grid;
      place-items: center;
      width: 100%;
      min-height: 52px;
      border: 0;
      border-radius: 10px;
      background: var(--green);
      color: #fff;
      text-decoration: none;
      font: inherit;
      font-weight: 900;
      font-size: 16px;
      cursor: pointer;
      box-shadow: 0 10px 22px rgba(18,99,72,.25);
    }
    .install-btn:active,
    .open-btn:active { transform: translateY(1px); }
    .install-btn:disabled {
      opacity: .55;
      cursor: default;
      box-shadow: none;
    }
    .status {
      margin: 0;
      padding: 10px 12px;
      border-radius: 8px;
      background: #e8f6ed;
      border: 1px solid #8bc1a8;
      color: var(--green-2);
      font-size: 13px;
      font-weight: 750;
      line-height: 1.4;
    }
    .status.warn {
      background: #fff9e7;
      border-color: #ead7a2;
      color: #68510a;
    }
    .status.ok {
      background: #e8f6ed;
      border-color: #8bc1a8;
      color: var(--green-2);
    }
    .fine {
      margin: 0;
      color: var(--muted);
      font-size: 12px;
      line-height: 1.45;
    }
    .guide h2 {
      margin: 0 0 6px;
      font-size: 14px;
      color: var(--green-2);
    }
    .guide[hidden] { display: none !important; }
    .steps {
      margin: 0;
      padding-left: 18px;
      color: #314034;
      font-size: 13px;
      line-height: 1.5;
    }
    .steps li + li { margin-top: 4px; }
    .back-link {
      justify-self: center;
      color: rgba(255,255,255,.9);
      font-size: 13px;
      font-weight: 800;
      text-shadow: 0 1px 8px rgba(0,0,0,.35);
    }
    .site-footer {
      width: min(640px, 100%);
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
        padding: 12px;
        padding-top: max(12px, env(safe-area-inset-top));
        padding-bottom: max(12px, env(safe-area-inset-bottom));
      }
      .panel { padding: 14px; }
      h1 { font-size: clamp(28px, 8vw, 40px); }
      .subtitle { font-size: clamp(18px, 5.2vw, 26px); }
    }
  </style>
</head>
<body>
  <main class="hero">
    <div class="wrap">
      <section class="brand">
        <small>Progressive Web App</small>
        <h1>GolfBangers.com</h1>
        <p class="subtitle">Install App</p>
        <p class="lead">Add Live Score to your home screen — fast access, app-like experience, no Play Store needed.</p>
      </section>

      <section class="panel" aria-label="Install GolfBangers app">
        <div class="app-row">
          <img class="app-icon" src="/icons/icon-192.png" width="64" height="64" alt="GolfBangers app icon">
          <div class="app-meta">
            <strong>GolfBangers Live Score</strong>
            <span>Install as a Progressive Web App</span>
          </div>
        </div>

        <div class="stats">
          <div class="stat">
            <span>Type</span>
            <b>PWA</b>
          </div>
          <div class="stat">
            <span>Works on</span>
            <b>Android · iOS · Desktop</b>
          </div>
          <div class="stat">
            <span>Mode</span>
            <b>Standalone</b>
          </div>
          <div class="stat">
            <span>Version</span>
            <b>v1.2.0</b>
          </div>
        </div>

        <p id="installStatus" class="status warn">Checking install support…</p>

        <button type="button" class="install-btn" id="installBtn" hidden>Install App</button>
        <a class="open-btn" id="openAppBtn" href="/?source=pwa" hidden>Open App</a>

        <div class="guide" id="guideAndroid" hidden>
          <h2>Android (Chrome)</h2>
          <ol class="steps">
            <li>Tap <b>Install App</b> above (or Chrome menu ⋮).</li>
            <li>Choose <b>Install app</b> / <b>Add to Home screen</b>.</li>
            <li>Open <b>GolfBangers</b> from your home screen.</li>
          </ol>
        </div>

        <div class="guide" id="guideIos" hidden>
          <h2>iPhone / iPad (Safari)</h2>
          <ol class="steps">
            <li>Tap the <b>Share</b> button.</li>
            <li>Choose <b>Add to Home Screen</b>.</li>
            <li>Tap <b>Add</b>, then open the GolfBangers icon.</li>
          </ol>
        </div>

        <div class="guide" id="guideDesktop" hidden>
          <h2>Desktop (Chrome / Edge)</h2>
          <ol class="steps">
            <li>Click <b>Install App</b> above.</li>
            <li>Or use the install icon in the address bar.</li>
            <li>Launch GolfBangers from your apps list.</li>
          </ol>
        </div>

        <p class="fine">Uses your browser — no APK sideload required for the best experience.</p>
      </section>

      <a class="back-link" href="/">← Back to Live Score</a>
    </div>

    <?php include dirname(__DIR__) . '/inc/footer.php'; ?>
  </main>

  <script>
    (() => {
      const statusEl = document.getElementById("installStatus");
      const installBtn = document.getElementById("installBtn");
      const openBtn = document.getElementById("openAppBtn");
      const guideAndroid = document.getElementById("guideAndroid");
      const guideIos = document.getElementById("guideIos");
      const guideDesktop = document.getElementById("guideDesktop");

      const ua = navigator.userAgent || "";
      const isIos = /iPad|iPhone|iPod/.test(ua) || (navigator.platform === "MacIntel" && navigator.maxTouchPoints > 1);
      const isAndroid = /Android/i.test(ua);
      const isStandalone = window.matchMedia("(display-mode: standalone)").matches
        || window.navigator.standalone === true;

      let deferredPrompt = null;

      function setStatus(text, type = "warn") {
        statusEl.textContent = text;
        statusEl.className = "status " + type;
      }

      function showGuide() {
        guideAndroid.hidden = true;
        guideIos.hidden = true;
        guideDesktop.hidden = true;
        if (isIos) guideIos.hidden = false;
        else if (isAndroid) guideAndroid.hidden = false;
        else guideDesktop.hidden = false;
      }

      if (isStandalone) {
        setStatus("GolfBangers is already installed on this device.", "ok");
        openBtn.hidden = false;
        showGuide();
        return;
      }

      showGuide();

      window.addEventListener("beforeinstallprompt", (event) => {
        event.preventDefault();
        deferredPrompt = event;
        installBtn.hidden = false;
        installBtn.disabled = false;
        setStatus("Ready to install. Tap the button below.", "ok");
      });

      window.addEventListener("appinstalled", () => {
        deferredPrompt = null;
        installBtn.hidden = true;
        openBtn.hidden = false;
        setStatus("Installed. You can open GolfBangers from your home screen.", "ok");
      });

      installBtn.addEventListener("click", async () => {
        if (!deferredPrompt) return;
        installBtn.disabled = true;
        deferredPrompt.prompt();
        const choice = await deferredPrompt.userChoice;
        deferredPrompt = null;
        if (choice.outcome === "accepted") {
          setStatus("Installing… Open the app from your home screen when done.", "ok");
          openBtn.hidden = false;
        } else {
          installBtn.disabled = false;
          installBtn.hidden = false;
          setStatus("Install canceled. You can try again anytime.", "warn");
        }
      });

      // Fallback messaging when browser does not fire beforeinstallprompt
      setTimeout(() => {
        if (isStandalone || deferredPrompt || !installBtn.hidden) return;
        if (isIos) {
          setStatus("On iPhone/iPad, use Safari Share → Add to Home Screen.", "warn");
        } else if (isAndroid) {
          setStatus("If Install App does not appear, open Chrome menu ⋮ → Install app / Add to Home screen.", "warn");
          installBtn.hidden = false;
          installBtn.textContent = "Open Live Score to Install";
          installBtn.onclick = () => { location.href = "/?source=pwa-install"; };
        } else {
          setStatus("Use Chrome or Edge, then click Install App or the install icon in the address bar.", "warn");
        }
      }, 1200);
    })();
  </script>
</body>
</html>
