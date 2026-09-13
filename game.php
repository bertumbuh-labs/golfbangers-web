<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GolfBangers.com</title>
  <?php include __DIR__ . '/inc/pwa-head.php'; ?>
  <style>
    :root {
      --bg: #f4f6f1;
      --card: #fff;
      --line: #d9dfd4;
      --ink: #20251f;
      --muted: #687264;
      --green: #176b4d;
      --soft: #e7f2ec;
      --red: #b5403c;
      --gold: #8a6400;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", sans-serif;
    }
    * { box-sizing: border-box; }
    html { height: 100%; }
    body {
      margin: 0;
      min-height: 100dvh;
      display: flex;
      flex-direction: column;
      background: var(--bg);
      color: var(--ink);
    }
    header {
      position: sticky; top: 0; z-index: 10;
      background: rgba(244,246,241,.95);
      border-bottom: 1px solid var(--line);
      backdrop-filter: blur(8px);
    }
    .top, main { max-width: 1280px; margin: 0 auto; }
    .top { padding: 14px 16px; display: flex; justify-content: space-between; align-items: center; gap: 12px; }
    h1, h2, h3, p { margin: 0; }
    h1 { font-size: 24px; letter-spacing: 0; }
    h2 { font-size: 16px; }
    p, .muted { color: var(--muted); font-size: 13px; }
    main { flex: 1 0 auto; width: 100%; padding: 16px; display: grid; gap: 14px; }
    section, .modal-card {
      background: #fff;
      border: 1px solid var(--line);
      border-radius: 8px;
      box-shadow: 0 1px 2px rgba(0,0,0,.04);
    }
    .head { padding: 12px 14px; border-bottom: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; gap: 10px; }
    #gamePanel > .head {
      position: sticky;
      top: var(--sticky-offset, 0px);
      z-index: 9;
      background: #fff;
      box-shadow: 0 2px 10px rgba(35,45,30,.08);
    }
    .body { padding: 14px; }
    .stack { display: grid; gap: 12px; }
    .row { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; }
    .grid2 { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 10px; }
    .grid3 { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 10px; }
    label { display: grid; gap: 5px; color: var(--muted); font-size: 12px; font-weight: 750; }
    input, select, button {
      min-height: 38px; border: 1px solid var(--line); border-radius: 6px;
      padding: 8px 9px; background: #fbfff8; color: var(--ink); font: inherit;
    }
    input:focus, select:focus {
      background: #e7f2ec;
      border-color: #91bea8;
      outline: 2px solid rgba(23, 107, 77, .16);
    }
    select option:checked { background: #d7ecdf; }
    input[type=number] { text-align: right; }
    button { cursor: pointer; font-weight: 800; }
    button.primary { color: #fff; background: var(--green); border-color: var(--green); }
    button.soft { background: var(--soft); border-color: #bdd7c9; color: var(--green); }
    .top-actions {
      display: flex;
      flex-wrap: nowrap;
      gap: 6px;
      align-items: center;
    }
    .top-actions > :not(.hide) {
      flex: 0 0 auto;
    }
    .top-actions > button:not(.hide) {
      flex: 1 1 0;
      min-width: 0;
      white-space: nowrap;
    }
    a.share-wa {
      display: grid;
      place-items: center;
      flex: 0 0 42px;
      width: 42px;
      min-width: 42px;
      min-height: 42px;
      padding: 0;
      border: 1px solid #9dd5b4;
      border-radius: 8px;
      background: #e8f6ed;
      color: #128c7e;
      text-decoration: none;
      line-height: 0;
    }
    a.share-wa svg {
      width: 20px;
      height: 20px;
      display: block;
    }
    a.share-wa:active { transform: translateY(1px); }
    a.share-wa.hide { display: none !important; }
    .pill { display: inline-flex; align-items: center; min-height: 24px; padding: 3px 8px; border-radius: 999px; font-size: 12px; font-weight: 850; background: #edf0ea; color: #4f594b; }
    .good { color: var(--green); background: var(--soft); }
    .bad { color: var(--red); background: #f8e7e7; }
    .warn { color: var(--gold); background: #fff1cb; }
    .setup-grid { display: grid; grid-template-columns: 330px 1fr; gap: 12px; align-items: start; }
    .players { display: grid; gap: 7px; }
    .player { display: grid; grid-template-columns: 30px minmax(0, 1fr) 36px; gap: 8px; align-items: center; }
    .btn-remove {
      width: 36px;
      min-width: 36px;
      min-height: 36px;
      padding: 0;
      border: 1px solid #e2aaa6;
      border-radius: 8px;
      background: #f8e7e7;
      color: #b5403c;
      box-shadow: none;
      display: grid;
      place-items: center;
      line-height: 1;
      font-size: 18px;
      font-weight: 900;
    }
    .btn-remove:hover {
      background: #b5403c;
      border-color: #b5403c;
      color: #fff;
    }
    .btn-remove:active { transform: translateY(1px); }
    .num { width: 30px; height: 30px; display: grid; place-items: center; border-radius: 50%; background: var(--soft); color: var(--green); font-size: 12px; font-weight: 900; }
    .checkline { display: inline-flex; align-items: center; gap: 6px; font-weight: 800; white-space: nowrap; }
    .checkline input { width: 18px; height: 18px; }
    .hint { padding: 10px; border: 1px solid #ead7a2; background: #fff9e7; border-radius: 8px; color: #68510a; font-size: 13px; line-height: 1.4; }
    .defaults { display: grid; gap: 6px; padding: 10px; border: 1px solid var(--line); border-radius: 8px; background: #fff; }
    .celebration { font-size: 18px; font-weight: 900; color: var(--green); }
    .table { overflow: auto; border: 1px solid var(--line); border-radius: 8px; background: #fff; }
    table { width: 100%; min-width: 720px; border-collapse: collapse; }
    th, td { padding: 8px; border-bottom: 1px solid var(--line); text-align: left; white-space: nowrap; font-size: 13px; }
    th { background: #f0f3ed; color: #4f594b; font-size: 12px; font-weight: 900; position: sticky; top: 0; z-index: 1; }
    th.score-total-col, td.score-total-col { background: #eef8ee; color: #103c2a; font-weight: 900; }
    th.score-grand-col, td.score-grand-col { background: #dff0e6; color: #06351f; font-weight: 950; }
    .scorecard-table { table-layout: fixed; width: 100%; min-width: 0; }
    .scorecard-table th, .scorecard-table td { text-align: center; padding: 6px 2px; font-size: 12px; }
    .scorecard-name { width: 15.5%; text-align: left !important; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .scorecard-name b { display: block; overflow: hidden; text-overflow: ellipsis; }
    .scorecard-hole { width: 3.25%; text-align: center !important; }
    col.scorecard-name-col { width: 15.5%; }
    col.scorecard-hole-col { width: 3.25%; }
    col.scorecard-total-col { width: 8.5%; }
    .scorecard-course { text-align: center !important; background: #145f43 !important; color: #fff; font-size: 11px; letter-spacing: 0; }
    .scorecard-course-note { margin-top: 8px; color: var(--muted); font-size: 12px; }
    .scorecard-total { width: 8.5%; text-align: center !important; }
    .gross-crown-wrap { position: relative; display: inline-block; min-width: 26px; text-align: center; white-space: nowrap; }
    .gross-crown { position: absolute; left: calc(100% + 3px); top: 50%; transform: translateY(-50%); display: inline-grid; place-items: center; width: 13px; height: 13px; border-radius: 50%; background: linear-gradient(180deg, #fff3ae, #d9a514); color: #6f4700; font-size: 8px; line-height: 1; box-shadow: inset 0 0 0 1px rgba(120,80,0,.18); }
    .scorecard-legend { margin-top: 6px; padding-right: 18px; text-align: right; color: var(--muted); font-size: 11px; font-weight: 800; }
    .scorecard-legend .gross-crown { position: static; transform: none; margin: 0 4px 0 0; vertical-align: -1px; }
    .score-mark { display: inline-grid; place-items: center; width: 18px; height: 18px; margin: 0 auto; font-size: 10px; font-weight: 900; font-variant-numeric: tabular-nums; line-height: 1; }
    .score-birdie { background: #fff0b8; color: #765000; clip-path: polygon(50% 7%, 94% 90%, 6% 90%); padding-top: 5px; }
    .score-eagle { border: 2px solid #126348; border-radius: 4px; color: #126348; background: #e7f4ec; }
    .scorecard-stack { display: none; }
    .scorecard-stack .scorecard-table { margin-top: 8px; }
    .scorecard-split .scorecard-table th, .scorecard-split .scorecard-table td { padding: 5px 2px; font-size: 12px; }
    .scorecard-split .scorecard-name { width: 22%; }
    .scorecard-split .scorecard-hole { width: 5.7%; }
    .scorecard-split .scorecard-total { width: 13.35%; }
    .scorecard-split col.scorecard-name-col { width: 22%; }
    .scorecard-split col.scorecard-hole-col { width: 5.7%; }
    .scorecard-split col.scorecard-total-col { width: 13.35%; }
    .scorecard-split.one-total .scorecard-name { width: 24%; }
    .scorecard-split.one-total .scorecard-hole { width: 6%; }
    .scorecard-split.one-total .scorecard-total { width: 22%; }
    .scorecard-split.one-total col.scorecard-name-col { width: 24%; }
    .scorecard-split.one-total col.scorecard-hole-col { width: 6%; }
    .scorecard-split.one-total col.scorecard-total-col { width: 22%; }
    .scorecard-split.nine-only .scorecard-name { width: 22%; }
    .scorecard-split.nine-only .scorecard-hole { width: 6.4%; }
    .scorecard-split.nine-only .scorecard-total { width: 20.4%; }
    .scorecard-split.nine-only col.scorecard-name-col { width: 22%; }
    .scorecard-split.nine-only col.scorecard-hole-col { width: 6.4%; }
    .scorecard-split.nine-only col.scorecard-total-col { width: 20.4%; }
    .matrix-table th:first-child {
      position: sticky;
      left: 0;
      z-index: 3;
      min-width: 132px;
      background: #f0f3ed;
      box-shadow: 1px 0 0 var(--line);
    }
    .matrix-table tbody th:first-child {
      background: #fbfcfa;
      z-index: 2;
    }
    .matrix-table thead th:first-child { z-index: 4; }
    .money { text-align: right; font-variant-numeric: tabular-nums; }
    .score { width: 72px; min-height: 34px; }
    .small { min-height: 34px; padding: 6px 7px; }
    .voor-empty { background: #fff; border-color: var(--line); color: var(--muted); }
    .voor-get { background: #e2f3e8; border-color: #9ecdae; color: #145f43; font-weight: 800; }
    .voor-give { background: #f9e4e2; border-color: #e2aaa6; color: #9c322e; font-weight: 800; }
    .voor-skret { background: #fff4cf; border-color: #e9d394; color: #725410; font-weight: 800; }
    .voor-nogame { background: #e4f1ff; border-color: #9fc6ed; color: #14527d; font-weight: 800; }
    .course-strip { display: grid; grid-template-columns: repeat(18, minmax(42px,1fr)); gap: 6px; }
    .hole-btn { min-height: 52px; display: grid; align-content: center; text-align: center; gap: 1px; padding: 5px; font-size: 12px; }
    .hole-btn b { font-size: 17px; }
    .hole-btn .par-label { font-size: 13px; font-weight: 800; }
    .hole-btn .index-label { font-size: 10px; color: inherit; opacity: .82; }
    .hole-btn.active { background: var(--green); color: #fff; border-color: var(--green); }
    .hole-btn.done:not(.active) { background: #eef5ef; border-color: #bfd5c8; }
    .scorecard-head { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 8px; }
    .metric { border: 1px solid var(--line); border-radius: 8px; padding: 9px; background: #fff; }
    .metric span { color: var(--muted); font-size: 12px; }
    .metric b { display: block; margin-top: 2px; font-size: 17px; }
    .metric-line { display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-top: 2px; }
    .metric-line b { margin-top: 0; min-width: 0; overflow: hidden; text-overflow: ellipsis; }
    .metric-line button { min-height: 32px; padding: 6px 8px; white-space: nowrap; }
    .game-layout { display: grid; gap: 12px; }
    .positive { color: var(--green); }
    .negative { color: var(--red); }
    .hide { display: none !important; }
    .modal {
      position: fixed; inset: 0; z-index: 50; display: none;
      background: rgba(20,25,20,.42); padding: 18px; overflow: auto;
    }
    .modal.show { display: grid; place-items: center; }
    .modal-card {
      width: min(1100px, 100%);
      max-height: min(90dvh, 900px);
      margin: 0;
      overflow: auto;
    }
    .ui-dialog {
      position: fixed;
      inset: 0;
      z-index: 90;
      display: none;
      place-items: center;
      padding: max(16px, env(safe-area-inset-top)) 16px max(16px, env(safe-area-inset-bottom));
      background: rgba(10, 18, 14, .52);
      backdrop-filter: blur(7px);
      -webkit-backdrop-filter: blur(7px);
    }
    .ui-dialog.show { display: grid; animation: uiFade .16s ease; }
    .ui-dialog-card {
      width: min(420px, 100%);
      max-height: min(85dvh, 640px);
      border: 1px solid rgba(255,255,255,.65);
      border-radius: 14px;
      background: #fff;
      box-shadow: 0 22px 54px rgba(0,0,0,.28);
      overflow: auto;
      transform: translateY(8px) scale(.97);
      animation: uiPop .2s cubic-bezier(.2,.8,.2,1) forwards;
    }
    .ui-dialog-accent {
      height: 3px;
      background: linear-gradient(90deg, #145f43, #3aaa78);
    }
    .ui-dialog.warn .ui-dialog-accent {
      background: linear-gradient(90deg, #a83b37, #d9785c);
    }
    .ui-dialog-body { padding: 18px 18px 6px; }
    .ui-dialog-kicker {
      margin: 0 0 6px;
      font-size: 11px;
      font-weight: 850;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: #176b4d;
    }
    .ui-dialog.warn .ui-dialog-kicker { color: #a83b37; }
    .ui-dialog-title {
      margin: 0 0 8px;
      font-size: 18px;
      line-height: 1.2;
      font-weight: 900;
      color: var(--ink);
    }
    .ui-dialog-msg {
      margin: 0;
      color: #5b675f;
      font-size: 14px;
      line-height: 1.5;
      white-space: pre-wrap;
    }
    .ui-dialog-actions {
      display: flex;
      gap: 8px;
      justify-content: flex-end;
      flex-wrap: wrap;
      padding: 14px 18px 18px;
    }
    .ui-dialog-actions button {
      width: auto;
      min-width: 96px;
      min-height: 42px;
      border-radius: 8px;
      padding: 8px 14px;
      font-weight: 850;
    }
    .ui-dialog-actions .ui-cancel {
      background: #f2f5f0;
      border-color: #d4dbd2;
      color: #4f594b;
      box-shadow: none;
    }
    .ui-dialog-actions .ui-ok {
      background: var(--green);
      border-color: var(--green);
      color: #fff;
      box-shadow: 0 8px 18px rgba(23,107,77,.18);
    }
    .ui-dialog.warn .ui-dialog-actions .ui-ok {
      background: #a83b37;
      border-color: #a83b37;
      box-shadow: 0 8px 18px rgba(168,59,55,.18);
    }
    @keyframes uiFade { from { opacity: 0; } to { opacity: 1; } }
    @keyframes uiPop { to { transform: none; } }
    @media (max-width: 620px) {
      .ui-dialog {
        padding: 16px;
        place-items: center;
        align-items: center;
        justify-items: center;
      }
      .ui-dialog-card {
        width: min(400px, calc(100vw - 32px));
        border-radius: 14px;
        margin: 0 auto;
      }
      .ui-dialog-actions { display: grid; grid-template-columns: 1fr 1fr; }
      .ui-dialog-actions button { width: 100%; min-width: 0; }
      .ui-dialog[data-mode="alert"] .ui-dialog-actions { grid-template-columns: 1fr; }
    }
    .summary-screen { max-width: 1180px; margin: 0 auto; display: grid; gap: 12px; }
    .cards { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 10px; }
    .card { position: relative; border: 1px solid var(--line); border-radius: 8px; padding: 11px; background: #fff; min-height: 90px; }
    .card strong { display: block; margin-bottom: 6px; }
    .card .total { font-size: 20px; font-weight: 900; font-variant-numeric: tabular-nums; }
    .breakdown { display: grid; gap: 4px; margin-top: 8px; }
    .breakdown-row { display: grid; grid-template-columns: minmax(96px, 1fr) auto; gap: 10px; align-items: baseline; color: var(--muted); font-size: 13px; }
    .breakdown-row b { font-variant-numeric: tabular-nums; text-align: right; color: var(--ink); }
    .breakdown-row b.positive { color: var(--green); }
    .breakdown-row b.negative { color: var(--red); }
    .rank-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      max-width: 44%;
      min-height: 24px;
      padding: 3px 8px;
      border-radius: 999px;
      font-size: 11px;
      font-weight: 950;
      line-height: 1;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      box-shadow: 0 1px 3px rgba(0,0,0,.08);
    }
    .rank-badge::before { font-size: 12px; line-height: 1; }
    .rank-gold { background: linear-gradient(180deg, #fff5c7, #f0c84d); color: #6f4900; border: 1px solid #d7a92b; }
    .rank-gold::before { content: "♛"; color: #8a5b00; }
    .rank-silver { background: linear-gradient(180deg, #f7f9fb, #d6dde5); color: #42505d; border: 1px solid #b7c1cb; }
    .rank-silver::before { content: "♛"; color: #596674; }
    .rank-spirit { background: #fff0f0; color: #a3312d; border: 1px solid #e1aaa7; }
    .print-only { display: none; }
    .site-footer {
      flex-shrink: 0;
      width: 100%;
      margin-top: auto;
      padding: 14px 16px max(18px, env(safe-area-inset-bottom));
      color: var(--muted);
      font-size: 12px;
      line-height: 1.45;
      text-align: center;
      border-top: 1px solid var(--line);
      background: rgba(244,246,241,.92);
    }
    .site-footer .footer-inner { max-width: 1280px; margin: 0 auto; }
    .site-footer .app-version {
      display: inline-block;
      margin-top: 6px;
      padding: 3px 9px;
      border-radius: 999px;
      border: 1px solid #c9d6cc;
      background: #eef4ef;
      color: #3e4d42;
      font-size: 11px;
      font-weight: 800;
      letter-spacing: .03em;
    }
    .tagline-short { display: none; }
    @media (max-width: 920px) {
      .setup-grid, .grid3 { grid-template-columns: 1fr; }
      .course-strip { grid-template-columns: repeat(9, minmax(42px,1fr)); }
      .scorecard-head, .cards { grid-template-columns: repeat(2, minmax(0,1fr)); }
      .top { flex-wrap: wrap; }
      .top > div:first-child { min-width: min(100%, 280px); flex: 1 1 240px; }
    }
    @media (max-width: 760px) {
      .scorecard-wide { display: none; }
      .scorecard-stack { display: grid; gap: 10px; }
      .scorecard-stack .table {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        overscroll-behavior-x: contain;
      }
      .scorecard-split .scorecard-table {
        min-width: 540px;
        table-layout: fixed;
      }
      .scorecard-split.nine-only .scorecard-table,
      .scorecard-split.one-total .scorecard-table { min-width: 500px; }
      .scorecard-table th, .scorecard-table td { padding: 7px 3px; font-size: 12px; }
      .scorecard-course { font-size: 11px; }
      .score-mark { width: 18px; height: 18px; font-size: 10px; }
      .scorecard-split .scorecard-name,
      .scorecard-split.one-total .scorecard-name,
      .scorecard-split.nine-only .scorecard-name {
        width: 76px;
        max-width: 76px;
        position: sticky;
        left: 0;
        z-index: 2;
        background: #fff;
        box-shadow: 1px 0 0 var(--line);
      }
      .scorecard-split th.scorecard-name,
      .scorecard-split.one-total th.scorecard-name,
      .scorecard-split.nine-only th.scorecard-name {
        background: #f0f3ed;
        z-index: 3;
      }
      .scorecard-split .scorecard-hole,
      .scorecard-split.one-total .scorecard-hole,
      .scorecard-split.nine-only .scorecard-hole { width: 36px; }
      .scorecard-split .scorecard-total,
      .scorecard-split.one-total .scorecard-total,
      .scorecard-split.nine-only .scorecard-total { width: 48px; }
      .scorecard-split col.scorecard-name-col,
      .scorecard-split.one-total col.scorecard-name-col,
      .scorecard-split.nine-only col.scorecard-name-col { width: 76px; }
      .scorecard-split col.scorecard-hole-col,
      .scorecard-split.one-total col.scorecard-hole-col,
      .scorecard-split.nine-only col.scorecard-hole-col { width: 36px; }
      .scorecard-split col.scorecard-total-col,
      .scorecard-split.one-total col.scorecard-total-col,
      .scorecard-split.nine-only col.scorecard-total-col { width: 48px; }
      .scorecard-legend { padding-right: 12px; text-align: left; }
      .matrix-table { min-width: 560px; }
    }
    @media (max-width: 620px) {
      body { padding-bottom: calc(88px + env(safe-area-inset-bottom)); }
      header { position: sticky; top: 0; }
      .top {
        display: grid;
        grid-template-columns: 1fr;
        gap: 8px;
        padding: 10px;
      }
      h1 { font-size: 18px; line-height: 1.15; }
      .tagline-long { display: none; }
      .tagline-short {
        display: block;
        font-size: 12px;
        line-height: 1.3;
        color: var(--muted);
      }
      .top .row.top-actions {
        display: flex;
        flex-wrap: nowrap;
        gap: 6px;
        width: 100%;
      }
      .top .top-actions > button:not(.hide) {
        flex: 1 1 0;
        min-width: 0;
        min-height: 42px;
        padding: 8px 6px;
        font-size: 12px;
      }
      .top .share-wa {
        flex: 0 0 42px;
        width: 42px;
        min-width: 42px;
        min-height: 42px;
        padding: 0;
      }
      .grid2, .scorecard-head, .cards { display: grid; grid-template-columns: 1fr; }
      main { padding: 8px; gap: 10px; }
      .head {
        padding: 10px;
        align-items: start;
        flex-wrap: wrap;
      }
      .head .row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        width: 100%;
        gap: 6px;
      }
      .head button { min-height: 40px; padding: 8px 6px; font-size: 12px; width: 100%; }
      .body { padding: 10px; }
      .hint { padding: 8px; font-size: 12px; }
      .player { grid-template-columns: 28px minmax(0, 1fr) 34px; gap: 6px; }
      .player .checkline { grid-column: 2; }
      .btn-remove { width: 34px; min-width: 34px; min-height: 34px; font-size: 16px; }
      .course-strip {
        display: flex;
        gap: 6px;
        overflow-x: auto;
        padding-bottom: 4px;
        scroll-snap-type: x proximity;
        -webkit-overflow-scrolling: touch;
      }
      .hole-btn { min-width: 58px; min-height: 52px; scroll-snap-align: start; flex: 0 0 auto; }
      .metric { padding: 8px; }
      .metric span { font-size: 11px; }
      .metric b { font-size: 18px; }
      .metric-line { flex-wrap: wrap; }
      #scoreTable.table { overflow: visible; border: 0; background: transparent; }
      #scoreTable .score-table { min-width: 0; border-collapse: separate; border-spacing: 0 8px; }
      #scoreTable .score-table thead { display: none; }
      #scoreTable .score-table tbody,
      #scoreTable .score-table tr,
      #scoreTable .score-table td { display: block; width: 100%; }
      #scoreTable .score-table tr {
        padding: 10px;
        border: 1px solid var(--line);
        border-radius: 8px;
        background: #fff;
      }
      #scoreTable .score-table td {
        padding: 6px 0;
        border: 0;
        white-space: normal;
      }
      #scoreTable .score-table td[data-label] {
        display: grid;
        grid-template-columns: minmax(88px, 34%) 1fr;
        align-items: center;
        gap: 8px;
      }
      #scoreTable .score-table td[data-label]::before {
        content: attr(data-label);
        color: var(--muted);
        font-size: 12px;
        font-weight: 800;
      }
      #scoreTable .score {
        width: 100%;
        min-height: 48px;
        text-align: center;
        font-size: 20px;
        font-weight: 900;
      }
      #scoreTable select.small { width: 100%; min-height: 44px; font-weight: 850; }
      #scoreTable .money { text-align: left; font-size: 16px; font-weight: 900; }
      #gamePanel .body > .row:last-child {
        position: fixed;
        left: 8px;
        right: 8px;
        bottom: max(8px, env(safe-area-inset-bottom));
        z-index: 30;
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 8px;
        padding: 8px;
        border: 1px solid var(--line);
        border-radius: 10px;
        background: rgba(244,246,241,.96);
        box-shadow: 0 12px 34px rgba(0,0,0,.18);
        backdrop-filter: blur(8px);
      }
      #prev { min-height: 48px; padding: 8px 10px; font-size: 12px; }
      #completeHole { min-height: 48px; font-size: 15px; }
      #status { grid-column: 1 / -1; justify-content: center; text-align: center; min-height: 24px; }
      .modal {
        padding: 16px;
        place-items: center;
        align-content: center;
      }
      .modal-card {
        margin: 0;
        max-height: min(88dvh, 100%);
      }
      .breakdown-row { grid-template-columns: minmax(0, 1fr) auto; font-size: 12px; }
      .rank-badge { max-width: 48%; font-size: 10px; }
      .site-footer { padding: 12px 12px max(16px, env(safe-area-inset-bottom)); font-size: 11px; }
      .site-footer .app-version { font-size: 10px; }
    }
    @media (max-width: 400px) {
      .scorecard-split .scorecard-table,
      .scorecard-split.nine-only .scorecard-table,
      .scorecard-split.one-total .scorecard-table { min-width: 460px; }
      #scoreTable .score-table td[data-label] { grid-template-columns: 78px 1fr; }
    }
    @media print {
      body > header, body > main, .modal .head button { display: none !important; }
      .modal { position: static; display: block !important; background: #fff; padding: 0; }
      .modal-card { box-shadow: none; border: 0; width: 100%; margin: 0; }
      .print-only { display: block; }
    }
  </style>
</head>
<body>
  <header>
    <div class="top">
      <div>
        <h1>GolfBangers.com</h1>
        <p class="tagline-long">Ciputra Golf Surabaya - Kata Ahok Golf itu APRESIASI - Rekapan Score Card, Voor, Face-to-Face, Single Winner, On-Berdie (Winner), dan Bacarat.</p>
        <p class="tagline-short">Ciputra Golf Surabaya · Live Score Card</p>
      </div>
      <div class="row top-actions">
        <a id="shareWhatsapp" class="share-wa hide" target="_blank" rel="noopener" aria-label="Share to WhatsApp" title="Share to WhatsApp">
          <svg viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"><path d="M12.04 2C6.58 2 2.15 6.4 2.15 11.84c0 1.94.56 3.74 1.54 5.28L2 22l5.05-1.62a9.86 9.86 0 0 0 4.99 1.27h.01c5.46 0 9.89-4.4 9.89-9.84C21.94 6.4 17.5 2 12.04 2zm5.75 13.98c-.24.68-1.4 1.24-1.93 1.32-.5.07-1.13.1-1.82-.11-.42-.13-.96-.31-1.65-.61-2.9-1.26-4.79-4.2-4.93-4.39-.14-.19-1.15-1.53-1.15-2.92 0-1.39.73-2.07.99-2.36.26-.29.57-.36.76-.36h.55c.17 0 .4-.06.63.48.24.56.8 1.94.87 2.08.07.14.12.3.02.49-.1.19-.14.3-.28.47-.14.16-.3.36-.42.49-.14.14-.28.29-.12.56.16.28.7 1.15 1.5 1.86 1.03.91 1.9 1.2 2.17 1.33.27.14.43.12.59-.07.16-.19.68-.79.86-1.06.18-.27.36-.22.61-.13.24.09 1.55.73 1.81.86.27.14.44.2.51.31.07.11.07.64-.17 1.32z"/></svg>
        </a>
        <button type="button" id="openAcakHole" class="soft">Acak Hole</button>
        <button type="button" id="editSetup" class="soft hide">Edit Setup</button>
        <button type="button" id="newRound">Ronde Baru</button>
      </div>
    </div>
  </header>

  <main>
    <section id="setupPanel">
      <div class="head">
        <h2>Setup Awal</h2>
        <span id="setupModeHint" class="pill warn">Isi urut dari atas ke bawah</span>
      </div>
      <div class="body stack">
        <div class="grid2">
          <label>Hole awal / 9 holes pertama
            <select id="front"><option value="valley">Lembah (Hole 1-9)</option><option value="lake">Danau (Hole 10-18)</option><option value="hill">Bukit (Hole 19-27)</option></select>
          </label>
          <label>Back nine
            <select id="back"><option value="lake">Danau (Hole 10-18)</option><option value="valley">Lembah (Hole 1-9)</option><option value="hill">Bukit (Hole 19-27)</option></select>
          </label>
        </div>

        <div class="setup-grid">
          <div class="stack">
            <h2>1. Nama Player</h2>
            <div id="players" class="players"></div>
            <div class="row">
              <button id="add">Tambah Player</button>
            </div>
            <label id="startBankerWrap">3. Bandar bacarat hole pertama
              <select id="startBanker"></select>
            </label>
            <label class="row" style="justify-content:flex-start;">
              <input id="useBacarat" type="checkbox" style="width:auto; min-height:auto;">
              Pakai Bacarat
            </label>
            <div id="rateSummary" class="defaults">
              <b>Default rates otomatis</b>
              <span class="muted">Face to face dan single winner mengikuti nominal yang sama. Birdie x2, eagle x5, HIO x10.</span>
            </div>
            <div class="row">
              <button id="editRates" class="soft">Ubah Rates</button>
            </div>
          </div>
          <div class="stack">
            <h2>2. Voor Semua Player</h2>
            <div class="hint">Isi jumlah hole voor per 9 holes. Contoh <b>2</b>: pemberi memberi 1 stroke di 2 hole tersulit. Contoh <b>+2</b>: player ini menerima voor 2 hole. Kosong atau <b>0</b> = Skret. Isi <b>x</b> kalau pair tersebut <b>No-Game</b> atau tidak bermain Face-to-Face/Single Winner. Voor hanya berlaku Par 4 dan Par 5.</div>
            <div id="matrix" class="table"></div>
          </div>
        </div>

        <div class="row">
          <button id="startGame" class="primary">Mulai Permainan</button>
          <span id="startHelp" class="muted">Setelah mulai, layar utama dibuat seperti score card dan progress dibuka lewat tombol.</span>
        </div>
      </div>
    </section>

    <section id="gamePanel" class="hide">
      <div class="head">
        <div>
          <h2 id="scoreCardTitle">Score Card</h2>
          <p id="holeTitle"></p>
        </div>
        <div class="row">
          <button id="viewTotal" class="soft">Progress Total</button>
          <button id="viewBacarat" class="soft">Progress Bacarat</button>
          <button id="viewMatchplay" class="soft">Matchplay</button>
          <button id="stopGolfer" class="soft">Golfer Tidak Lanjut</button>
          <button id="viewScoreCard" class="soft">Current Score Card</button>
          <button id="viewLedger">Ledger</button>
        </div>
      </div>
      <div class="body game-layout">
        <div id="startMessage" class="celebration hide">Gasss Bangerss !!! Bring it On !! Have Fun.</div>
        <div class="hint">Input score memakai angka relatif terhadap par: 0 = par, 1 = bogey, -1 = birdie, -2 = eagle.</div>
        <div id="holes" class="course-strip"></div>
        <div id="meta" class="scorecard-head"></div>
        <div id="scoreTable" class="table"></div>
        <div class="row">
          <button id="prev">Hole Sebelumnya</button>
          <button id="completeHole" class="primary">Simpan Hole & Lanjut</button>
          <span id="status" class="pill"></span>
        </div>
      </div>
    </section>
  </main>

  <section id="nineSummaryPanel" class="hide">
    <div class="head">
      <div>
        <h2>Rekapan 9 Holes</h2>
        <p id="nineSummarySubtitle"></p>
      </div>
    </div>
    <div class="body summary-screen">
      <div id="nineCoffee" class="hint"></div>
      <div id="nineGrossCard" class="table"></div>
      <div id="nineCards" class="cards"></div>
      <div class="hint" id="nineNextBanker"></div>
      <div class="row"><button id="adjustBackNine" class="soft">Adjust Voor Back9?</button><button id="continueAfterNine" class="primary">Lanjut</button></div>
    </div>
  </section>
  <section id="finalSummaryPanel" class="hide">
    <div class="head">
      <div>
        <h2>What a Game! See You Next Game! - Go Go Bangers.</h2>
        <p>Final summary after 18 holes.</p>
      </div>
    </div>
    <div class="body summary-screen">
      <div id="finalProgress"></div>
      <div id="finalGrossCard" class="table"></div>
      <div class="hint">Jangan lupa cek voor untuk game selanjutnya berdasarkan hasil matchplay.</div>
      <div class="row"><button id="finalMatchplay" class="primary">Check Matchplay</button><button id="backToScoreCard">Kembali ke Score Card</button></div>
    </div>
  </section>
  <?php
  $footer_wrap_inner = true;
  include __DIR__ . '/inc/footer.php';
  ?>

  <div id="modal" class="modal">
    <div class="modal-card">
      <div class="head">
        <h2 id="modalTitle">Progress</h2>
        <button id="closeModal">Tutup</button>
      </div>
      <div id="modalBody" class="body stack"></div>
    </div>
  </div>

  <div id="uiDialog" class="ui-dialog" aria-hidden="true">
    <div class="ui-dialog-card" role="alertdialog" aria-modal="true" aria-labelledby="uiDialogTitle" aria-describedby="uiDialogMsg">
      <div class="ui-dialog-accent"></div>
      <div class="ui-dialog-body">
        <p class="ui-dialog-kicker" id="uiDialogKicker">Info</p>
        <h3 class="ui-dialog-title" id="uiDialogTitle">Pesan</h3>
        <p class="ui-dialog-msg" id="uiDialogMsg"></p>
      </div>
      <div class="ui-dialog-actions">
        <button type="button" class="ui-cancel" id="uiDialogCancel">Batal</button>
        <button type="button" class="ui-ok" id="uiDialogOk">OK</button>
      </div>
    </div>
  </div>

  <script>
    const COURSE = {
      valley: { name: "Lembah", holes: [
        [1,1,5,15], [2,2,3,17], [3,3,4,5], [4,4,4,3], [5,5,4,1],
        [6,6,4,13], [7,7,4,11], [8,8,3,9], [9,9,5,7]
      ]},
      lake: { name: "Danau", holes: [
        [10,1,4,10], [11,2,4,18], [12,3,3,16], [13,4,5,6], [14,5,4,14],
        [15,6,4,4], [16,7,4,2], [17,8,3,12], [18,9,5,8]
      ]},
      hill: { name: "Bukit", holes: [
        [19,1,4,{ lake: 1, valley: 2 }],
        [20,2,4,{ lake: 17, valley: 18 }],
        [21,3,3,{ lake: 7, valley: 8 }],
        [22,4,4,{ lake: 15, valley: 16 }],
        [23,5,4,{ lake: 3, valley: 4 }],
        [24,6,5,{ lake: 11, valley: 12 }],
        [25,7,3,{ lake: 5, valley: 6 }],
        [26,8,4,{ lake: 9, valley: 10 }],
        [27,9,5,{ lake: 13, valley: 14 }]
      ]}
    };
    const APP_BUILD = "2026-06-01-live-test-v1";
    const APP_VERSION = "1.2.0";
    const KEY = "the-bangers-v3";
    const LIVE_PARAMS = new URLSearchParams(window.location.search);
    const LIVE_GAME_ID = LIVE_PARAMS.get("id") || "";
    const LIVE_EDIT_TOKEN = LIVE_PARAMS.get("edit") || "";
    const LIVE_CAN_EDIT = !!LIVE_EDIT_TOKEN;
    const LIVE_CACHE_KEY = LIVE_GAME_ID ? `${KEY}-live-${LIVE_GAME_ID}` : "";
    let liveLoading = false;
    let liveSaveTimer = null;
    let liveLastUpdated = "";
    let liveSaveStatus = "";
    let uiDialogResolver = null;
    const fmt = new Intl.NumberFormat("id-ID");

    function uiDialog({
      title = "Pesan",
      message = "",
      mode = "alert",
      tone = "info",
      okText = "OK",
      cancelText = "Batal",
      kicker
    } = {}) {
      const root = document.getElementById("uiDialog");
      const cancelBtn = document.getElementById("uiDialogCancel");
      const okBtn = document.getElementById("uiDialogOk");
      document.getElementById("uiDialogKicker").textContent = kicker || (mode === "confirm" ? "Konfirmasi" : tone === "warn" ? "Perhatian" : "Info");
      document.getElementById("uiDialogTitle").textContent = title;
      document.getElementById("uiDialogMsg").textContent = message;
      root.dataset.mode = mode;
      root.classList.toggle("warn", tone === "warn");
      cancelBtn.textContent = cancelText;
      okBtn.textContent = okText;
      cancelBtn.style.display = mode === "confirm" ? "" : "none";
      root.classList.add("show");
      root.setAttribute("aria-hidden", "false");
      setTimeout(() => okBtn.focus(), 20);
      return new Promise(resolve => {
        uiDialogResolver = resolve;
      });
    }
    function closeUiDialog(result) {
      const root = document.getElementById("uiDialog");
      if (!root) return;
      root.classList.remove("show");
      root.setAttribute("aria-hidden", "true");
      const resolve = uiDialogResolver;
      uiDialogResolver = null;
      if (resolve) resolve(result);
    }
    function uiAlert(message, opts = {}) {
      return uiDialog({
        title: opts.title || "Perhatian",
        message,
        mode: "alert",
        tone: opts.tone || "info",
        okText: opts.okText || "Mengerti",
        kicker: opts.kicker
      });
    }
    function uiConfirm(message, opts = {}) {
      return uiDialog({
        title: opts.title || "Konfirmasi",
        message,
        mode: "confirm",
        tone: opts.tone || "warn",
        okText: opts.okText || "Ya",
        cancelText: opts.cancelText || "Batal",
        kicker: opts.kicker
      });
    }
    function bindUiDialogActions() {
      const root = document.getElementById("uiDialog");
      const okBtn = document.getElementById("uiDialogOk");
      const cancelBtn = document.getElementById("uiDialogCancel");
      if (!root || !okBtn || !cancelBtn || root.dataset.bound === "1") return;
      root.dataset.bound = "1";
      const finish = (result, e) => {
        e.preventDefault();
        e.stopPropagation();
        closeUiDialog(result);
      };
      okBtn.addEventListener("click", e => {
        finish(root.dataset.mode === "confirm" ? true : undefined, e);
      });
      cancelBtn.addEventListener("click", e => finish(false, e));
      root.addEventListener("click", e => {
        if (e.target === root) finish(root.dataset.mode === "confirm" ? false : undefined, e);
      });
      document.addEventListener("keydown", e => {
        if (!root.classList.contains("show")) return;
        if (e.key === "Escape") {
          e.preventDefault();
          e.stopPropagation();
          closeUiDialog(root.dataset.mode === "confirm" ? false : undefined);
        } else if (e.key === "Enter" && e.target?.tagName !== "TEXTAREA" && e.target?.tagName !== "BUTTON") {
          e.preventDefault();
          okBtn.click();
        }
      });
    }
    bindUiDialogActions();

    const defaultState = () => ({
      started: false,
      gameDate: "",
      players: ["", "", "", ""],
      front: "valley",
      back: "lake",
      active: 0,
      startBanker: 0,
      useBacarat: true,
      rates: { f2f: 100000, winner: 100000, par3Bonus: 100000, bacarat: 50000, bacaratPar3: 100000 },
      voor: {},
      activeFrom: {},
      inactiveFrom: {},
      editingSetup: false,
      showNineSummary: false,
      showFinalSummary: false,
      holes: []
    });
    let state = defaultState();

    function roundHoles() {
      const first = COURSE[state.front].holes.map((h, i) => makeHole(h, COURSE[state.front].name, 0, i + 1, state.back));
      const second = COURSE[state.back].holes.map((h, i) => makeHole(h, COURSE[state.back].name, 1, i + 10, state.front));
      return [...first, ...second];
    }
    function makeHole(h, course, nine, roundNo, pairedCourse) {
      const index = typeof h[3] === "object" ? h[3][pairedCourse] || h[3].lake || h[3].valley : h[3];
      return { global: h[0], local: h[1], par: h[2], index, course, nine, roundNo };
    }
    function normalizeCoursePair(changedId) {
      return;
    }
    function blankHole(banker = 0) {
      return {
        completed: false,
        scores: Array(state.players.length).fill(""),
        banker,
        manualBanker: false,
        needsManualBanker: false,
        nextBanker: null,
        bankerMult: 1,
        onGreen: Array(state.players.length).fill(false),
        baccarat: Array(state.players.length).fill(0).map(() => ({ play: true, playerMult: 1, bankerMult: 1 }))
      };
    }
    function ensure() {
      const len = roundHoles().length;
      while (state.holes.length < len) state.holes.push(blankHole(state.startBanker));
      state.holes = state.holes.slice(0, len);
      if (state.useBacarat === undefined) state.useBacarat = true;
      state.holes.forEach((h, idx) => {
        h.scores = resize(h.scores || [], state.players.length, "");
        h.onGreen = resize(h.onGreen || [], state.players.length, false).map(Boolean);
        h.baccarat = resize(h.baccarat || [], state.players.length, null).map(x => x || { play: true, playerMult: 1, bankerMult: 1 });
        if (!h.bankerMult) h.bankerMult = 1;
        if (h.manualBanker === undefined) h.manualBanker = false;
        if (h.needsManualBanker === undefined) h.needsManualBanker = false;
        if (h.banker >= state.players.length) h.banker = 0;
        if (idx === 0 && !h.manualBanker) h.banker = state.startBanker;
      });
    }
    function resize(arr, len, fill) {
      const out = arr.slice(0, len);
      while (out.length < len) out.push(typeof fill === "function" ? fill() : fill);
      return out;
    }
    function names() {
      return state.players.map((p, i) => p.trim() || `Player ${i + 1}`);
    }
    function todayIso() {
      return new Date().toISOString().slice(0, 10);
    }
    function displayDate(value = state.gameDate) {
      if (!value) return "-";
      const [year, month, day] = value.split("-");
      return `${day}/${month}/${year}`;
    }
    function isActive(player, holeIdx) {
      const startAt = Number(state.activeFrom?.[player] ?? 0);
      const stopAt = state.inactiveFrom?.[player];
      const stopped = stopAt !== undefined && stopAt !== null && holeIdx >= Number(stopAt);
      return holeIdx >= startAt && !stopped;
    }
    function activeIndexes(holeIdx) {
      return state.players.map((_, idx) => idx).filter(idx => isActive(idx, holeIdx));
    }
    function activePlayers() {
      const filtered = state.players.map(p => p.trim()).filter(Boolean);
      return filtered.length >= 2 ? filtered : names();
    }
    function parseVoor(value) {
      const clean = String(value || "").trim().replace(/^\+/, "");
      if (!clean || clean.toLowerCase() === "skret") return { stroke: 0, count: 0 };
      const simple = clean.match(/^(\d+)$/);
      if (simple) return { stroke: 1, count: Number(simple[1]) };
      const legacy = clean.match(/^(\d+)\s*@\s*(\d+)$/);
      return legacy ? { stroke: Number(legacy[1]), count: Number(legacy[2]) } : { stroke: 0, count: 0 };
    }
    function formatVoor(value) {
      const clean = String(value || "").trim();
      if (!clean) return "";
      if (clean.toLowerCase() === "skret") return "Skret";
      if (["x", "no-game", "nogame"].includes(clean.toLowerCase())) return "No-Game";
      const prefix = clean.startsWith("+") ? "+" : "";
      const parsed = parseVoor(clean);
      return parsed.count ? `${prefix}${parsed.count}` : clean;
    }
    function pairDisabled(a, b) {
      return [state.voor[`${a}-${b}`], state.voor[`${b}-${a}`]].some(value => ["x", "no-game", "nogame"].includes(String(value || "").trim().toLowerCase()));
    }
    function voorStroke(giver, receiver, holeIdx) {
      const direct = String(state.voor[`${giver}-${receiver}`] || "").trim();
      if (!direct || direct.startsWith("+") || ["skret", "x", "no-game", "nogame"].includes(direct.toLowerCase())) return 0;
      const rule = parseVoor(direct);
      const hole = roundHoles()[holeIdx];
      if (!rule.stroke || !rule.count || ![4,5].includes(hole.par)) return 0;
      const eligible = roundHoles()
        .map((h, idx) => ({ ...h, idx }))
        .filter(h => h.nine === hole.nine && [4,5].includes(h.par))
        .sort((a, b) => a.index - b.index)
        .slice(0, rule.count)
        .map(h => h.idx);
      return eligible.includes(holeIdx) ? rule.stroke : 0;
    }
    function netVs(player, opponent, holeIdx, score) {
      return Number.isFinite(score) ? score - voorStroke(opponent, player, holeIdx) : null;
    }
    function scoreMultiplier(hole, score) {
      if (!Number.isFinite(score)) return { mult: 1, label: "x1" };
      if (hole.par === 3 && score <= 1 - hole.par) return { mult: 10, label: "HIO x10" };
      if (score <= -2) return { mult: 5, label: "Eagle x5" };
      if (score === -1) return { mult: 2, label: "Birdie x2" };
      return { mult: 1, label: "x1" };
    }
    function bestNetForHole(player, holeIdx) {
      if (!isActive(player, holeIdx)) return null;
      const score = Number(state.holes[holeIdx].scores[player]);
      if (!Number.isFinite(score)) return null;
      return Math.min(...activeIndexes(holeIdx).map(opponent => opponent === player ? score : netVs(player, opponent, holeIdx, score)));
    }
    function holeComplete(holeIdx) {
      const active = activeIndexes(holeIdx);
      const scores = state.holes[holeIdx].scores.map(Number);
      return active.every(player => Number.isFinite(scores[player]));
    }
    function holeLeaders(holeIdx) {
      const active = activeIndexes(holeIdx);
      const scores = state.holes[holeIdx].scores.map(Number);
      if (!holeComplete(holeIdx)) return [];
      return active.filter(player => active.every(opponent => {
        if (opponent === player) return true;
        if (pairDisabled(player, opponent)) return true;
        return netVs(player, opponent, holeIdx, scores[player]) <= netVs(opponent, player, holeIdx, scores[opponent]);
      }));
    }
    function holeWinners(holeIdx) {
      const active = activeIndexes(holeIdx);
      const scores = state.holes[holeIdx].scores.map(Number);
      if (!holeComplete(holeIdx)) return [];
      return active.filter(player => active.every(opponent => {
        if (opponent === player) return true;
        if (pairDisabled(player, opponent)) return true;
        return netVs(player, opponent, holeIdx, scores[player]) < netVs(opponent, player, holeIdx, scores[opponent]);
      }));
    }
    function resolveNextBanker(holeIdx) {
      const currentActive = activeIndexes(holeIdx);
      const scores = state.holes[holeIdx].scores.map(Number);
      const active = activeIndexes(Math.min(holeIdx + 1, roundHoles().length - 1));
      const fallback = active.includes(state.holes[holeIdx].banker) ? state.holes[holeIdx].banker : active[0] ?? state.holes[holeIdx].banker;
      if (!holeComplete(holeIdx)) return { banker: fallback, note: "score belum lengkap" };
      const bestGross = Math.min(...currentActive.map(player => scores[player]));
      let tied = currentActive.filter(player => scores[player] === bestGross);
      if (tied.length === 1) return { banker: tied[0], note: "best gross" };

      const netWinners = tied.filter(player => tied.every(opponent => {
        if (opponent === player) return true;
        return netVs(player, opponent, holeIdx, scores[player]) < netVs(opponent, player, holeIdx, scores[opponent]);
      }));
      if (netWinners.length === 1) return { banker: netWinners[0], note: "draw gross, menang net voor" };

      const netLeaders = tied.filter(player => tied.every(opponent => {
        if (opponent === player) return true;
        return netVs(player, opponent, holeIdx, scores[player]) <= netVs(opponent, player, holeIdx, scores[opponent]);
      }));
      tied = netLeaders.length ? netLeaders : tied;
      if (tied.length === 1) return { banker: tied[0], note: "draw gross, unggul net voor" };
      if (tied.includes(state.holes[holeIdx].banker)) {
        return { banker: state.holes[holeIdx].banker, note: "draw, banker sebelumnya termasuk kandidat" };
      }
      return { banker: fallback, note: "bandar draw, silakan pilih bandar untuk hole selanjutnya", manualRequired: true };
    }
    function nextBankerAfter(holeIdx) {
      const holes = roundHoles();
      if (holes[holeIdx]?.par === 3 && holeIdx > 0) {
        const previous = resolveNextBanker(holeIdx - 1);
        return { ...previous, note: `setelah Par 3, lihat hole ${holes[holeIdx - 1].roundNo}` };
      }
      return resolveNextBanker(holeIdx);
    }
    function manualBankerRequired(holeIdx) {
      return state.useBacarat && (roundHoles()[holeIdx]?.par === 3 || !!state.holes[holeIdx]?.needsManualBanker);
    }
    function addMoney(totals, winner, loser, amount, bucket) {
      totals[winner][bucket] += amount;
      totals[loser][bucket] -= amount;
    }
    function ledgerItem(hole, type, win, lose, amount, note) {
      return { hole: hole.roundNo, type, win, lose, amount, note };
    }
    function calc(until = state.active) {
      const totals = state.players.map(() => ({ f2f: 0, winner: 0, birdie: 0, bacarat: 0, total: 0 }));
      const ledger = [];
      roundHoles().forEach((hole, hi) => {
        const entry = state.holes[hi];
        if (hi > until || !entry.completed) return;
        const scores = entry.scores.map(Number);
        const active = activeIndexes(hi);
        for (let ai = 0; ai < active.length; ai++) {
          for (let bi = ai + 1; bi < active.length; bi++) {
            const a = active[ai];
            const b = active[bi];
            if (pairDisabled(a, b)) continue;
            const na = netVs(a, b, hi, scores[a]);
            const nb = netVs(b, a, hi, scores[b]);
            if (na === nb) continue;
            const win = na < nb ? a : b;
            const lose = win === a ? b : a;
            const bonus = scoreMultiplier(hole, scores[win]);
            const amount = state.rates.f2f * bonus.mult;
            addMoney(totals, win, lose, amount, "f2f");
            ledger.push(ledgerItem(hole, "Face to face", win, lose, amount, `${names()[win]} vs ${names()[lose]} (${bonus.label})`));
          }
        }
        const winners = holeWinners(hi);
        if (winners.length === 1) {
          const win = winners[0];
          active.forEach(lose => {
            if (lose === win) return;
            if (pairDisabled(win, lose)) return;
            const bonus = scoreMultiplier(hole, scores[win]);
            const amount = state.rates.winner * bonus.mult;
            addMoney(totals, win, lose, amount, "winner");
            ledger.push(ledgerItem(hole, "Single winner", win, lose, amount, `Net ${bestNetForHole(win, hi)} (${bonus.label})`));
          });
        }
        const birdies = active.map(idx => scores[idx] === -1 && entry.onGreen?.[idx] ? idx : -1).filter(idx => idx >= 0);
        if (hole.par === 3 && birdies.length === 1) {
          const win = birdies[0];
          active.forEach(lose => {
            if (lose === win) return;
            if (pairDisabled(win, lose)) return;
            addMoney(totals, win, lose, state.rates.par3Bonus, "birdie");
            ledger.push(ledgerItem(hole, "On Berdie Par 3", win, lose, state.rates.par3Bonus, "Birdie dan On Green"));
          });
        }
        if (!state.useBacarat) return;
        if (manualBankerRequired(hi) && !entry.manualBanker) return;
        const banker = entry.banker;
        if (!active.includes(banker)) return;
        active.forEach(player => {
          if (player === banker) return;
          if (pairDisabled(player, banker)) return;
          const bet = entry.baccarat[player];
          const playerNet = netVs(player, banker, hi, scores[player]);
          const bankerNet = netVs(banker, player, hi, scores[banker]);
          if (playerNet === bankerNet) return;
          const win = playerNet < bankerNet ? player : banker;
          const lose = win === player ? banker : player;
          const base = hole.par === 3 ? state.rates.bacaratPar3 : state.rates.bacarat;
          const bankerMult = Number(entry.bankerMult || bet.bankerMult || 1);
          const amount = base * Number(bet.playerMult || 1) * bankerMult;
          addMoney(totals, win, lose, amount, "bacarat");
          ledger.push(ledgerItem(hole, "Bacarat", win, lose, amount, `P x${bet.playerMult}, B x${bankerMult}`));
        });
      });
      totals.forEach(t => t.total = t.f2f + t.winner + t.birdie + t.bacarat);
      return { totals, ledger };
    }
    function calcCompletedThrough(limit) {
      return state.holes.filter((hole, idx) => idx <= limit && hole.completed).length;
    }
    function coffeeMessage() {
      if (calcCompletedThrough(8) < 9) return "";
      const ns = names();
      const c = calc(8);
      const best = Math.max(...c.totals.map(t => t.total));
      const winners = c.totals.map((t, i) => t.total === best ? ns[i] : "").filter(Boolean);
      const buyer = winners.length === 1 ? winners[0] : winners.join(" & ");
      return `After 9 holes, Coffee dibelikan oleh ${buyer}. Semangat terusss yaaa jaga kemenangan ini. Gasss !!`;
    }
    function pairMatch(a, b, until = roundHoles().length - 1) {
      let aWins = 0, bWins = 0, draws = 0;
      roundHoles().forEach((hole, idx) => {
        if (idx > until || !state.holes[idx].completed || !isActive(a, idx) || !isActive(b, idx)) return;
        if (pairDisabled(a, b)) return;
        const scores = state.holes[idx].scores.map(Number);
        const netA = netVs(a, b, idx, scores[a]);
        const netB = netVs(b, a, idx, scores[b]);
        if (netA < netB) aWins += 1;
        else if (netB < netA) bWins += 1;
        else draws += 1;
      });
      return { aWins, bWins, draws, diff: aWins - bWins };
    }
    function voorText(giver, receiver) {
      return formatVoor(state.voor[`${giver}-${receiver}`]) || "Skret";
    }
    function givingVoorCount(giver, receiver) {
      const raw = String(state.voor[`${giver}-${receiver}`] || "").trim();
      if (!raw || raw.startsWith("+") || ["skret", "x", "no-game", "nogame"].includes(raw.toLowerCase())) return 0;
      return parseVoor(raw).count || 0;
    }
    function actualVoorText(primary, other) {
      if (pairDisabled(primary, other)) return "Tidak main";
      const primaryGives = givingVoorCount(primary, other);
      if (primaryGives) return `${names()[primary]} ke ${names()[other]}: ${primaryGives}`;
      const otherGives = givingVoorCount(other, primary);
      if (otherGives) return `${names()[other]} ke ${names()[primary]}: ${otherGives}`;
      return `${names()[primary]} ke ${names()[other]}: Skret`;
    }
    function recommendVoor(a, b, diff) {
      const steps = Math.floor(Math.abs(diff) / 3);
      const winner = diff > 0 ? a : b;
      const loser = diff > 0 ? b : a;
      if (!steps) return actualVoorText(a, b);
      const currentWinnerGives = givingVoorCount(winner, loser);
      const currentLoserGives = givingVoorCount(loser, winner);
      if (currentLoserGives) {
        if (currentLoserGives > steps) {
          return `${names()[loser]} ke ${names()[winner]}: ${currentLoserGives - steps}`;
        }
        const excess = steps - currentLoserGives;
        return excess ? `${names()[winner]} ke ${names()[loser]}: ${excess}` : `${names()[winner]} ke ${names()[loser]}: Skret`;
      }
      const nextCount = currentWinnerGives + steps;
      return `${names()[winner]} ke ${names()[loser]}: ${nextCount}`;
    }
    function matchplayHtml(filterPlayer = "all") {
      const ns = names();
      const filter = filterPlayer === "all" ? "all" : Number(filterPlayer);
      const rows = [];
      for (let a = 0; a < state.players.length; a++) {
        for (let b = a + 1; b < state.players.length; b++) {
          if (filter !== "all" && a !== filter && b !== filter) continue;
          const m = pairMatch(a, b);
          const winnerIdx = m.diff > 0 ? a : m.diff < 0 ? b : null;
          const loserIdx = m.diff > 0 ? b : m.diff < 0 ? a : null;
          const winner = winnerIdx === null ? "All square" : ns[winnerIdx];
          const upDown = m.diff === 0 ? "AS" : `${Math.abs(m.diff)} up`;
          const voorNow = actualVoorText(a, b);
          rows.push(`<tr>
            <td>${esc(ns[a])} vs ${esc(ns[b])}</td>
            <td>${esc(winner)}</td>
            <td>${upDown}</td>
            <td>${m.aWins}-${m.bWins}-${m.draws}</td>
            <td>${esc(voorNow)}</td>
            <td>${esc(recommendVoor(a, b, m.diff))}</td>
          </tr>`);
        }
      }
      return `<div class="hint"><b>Tanggal Game: ${displayDate()}</b></div>
        <label>Tampilkan golfer
          <select id="matchplayFilter"><option value="all" ${filter === "all" ? "selected" : ""}>Semua golfer</option>${ns.map((n, i) => `<option value="${i}" ${filter === i ? "selected" : ""}>${esc(n)}</option>`).join("")}</select>
        </label>
        <div class="hint">Adjust voor game berikutnya hanya kalau selisih matchplay mencapai kelipatan 3 holes. Menang 3 holes = naik/turun 1 slot, menang 6 holes = 2 slot, dan seterusnya.</div>
        <div class="table"><table><thead><tr><th>Match</th><th>Winner</th><th>Up/Down</th><th>W-L-AS</th><th>Voor Sekarang</th><th>Rekomendasi Next Game</th></tr></thead><tbody>${rows.join("") || `<tr><td colspan="6">Belum ada data.</td></tr>`}</tbody></table></div>`;
    }
    function settlementRows() {
      const ns = names();
      const totals = calc(roundHoles().length - 1).totals.map((t, i) => ({ name: ns[i], amount: t.total }));
      const creditors = totals.filter(t => t.amount > 0).sort((a,b) => b.amount - a.amount);
      const debtors = totals.filter(t => t.amount < 0).map(t => ({ name: t.name, amount: -t.amount })).sort((a,b) => b.amount - a.amount);
      const rows = [];
      let i = 0, j = 0;
      while (i < debtors.length && j < creditors.length) {
        const amount = Math.min(debtors[i].amount, creditors[j].amount);
        if (amount > 0) rows.push({ from: debtors[i].name, to: creditors[j].name, amount });
        debtors[i].amount -= amount;
        creditors[j].amount -= amount;
        if (debtors[i].amount <= 0) i += 1;
        if (creditors[j].amount <= 0) j += 1;
      }
      return rows;
    }
    function reportHtml() {
      const ns = names();
      const c = calc(roundHoles().length - 1);
      const settlement = settlementRows();
      return `<div class="print-only"><h1>GolfBangers.com</h1><p>Ciputra Golf Surabaya Report - ${displayDate()}</p></div>
        <div class="hint"><b>Tanggal Game: ${displayDate()}</b></div>
        ${coffeeMessage() ? `<div class="hint"><b>${esc(coffeeMessage())}</b></div>` : ""}
        ${progressHtml("total")}
        <h2>Siapa Bayar ke Siapa</h2>
        <div class="table"><table><thead><tr><th>Bayar Dari</th><th>Ke</th><th class="money">Jumlah</th></tr></thead><tbody>${settlement.length ? settlement.map(r => `<tr><td>${esc(r.from)}</td><td>${esc(r.to)}</td><td class="money">Rp ${fmt.format(r.amount)}</td></tr>`).join("") : `<tr><td colspan="3">Belum ada settlement.</td></tr>`}</tbody></table></div>
        <h2>Matchplay & Voor Next Game</h2>
        ${matchplayHtml()}
        <h2>Ledger</h2>
        ${ledgerHtml()}`;
    }
    function signed(value) {
      const cls = value > 0 ? "positive" : value < 0 ? "negative" : "";
      const sign = value > 0 ? "+" : value < 0 ? "-" : "";
      return `<span class="${cls}">${sign}Rp ${fmt.format(Math.abs(value))}</span>`;
    }
    function esc(value) {
      return String(value ?? "").replace(/[&<>"']/g, ch => ({ "&":"&amp;", "<":"&lt;", ">":"&gt;", '"':"&quot;", "'":"&#039;" }[ch]));
    }
    function liveApi(action) {
      return `api.php?action=${encodeURIComponent(action)}&id=${encodeURIComponent(LIVE_GAME_ID)}`;
    }
    function hasVoorData(source) {
      return Object.values(source?.voor || {}).some(value => String(value || "").trim());
    }
    function hasVoorObject(voor) {
      return Object.values(voor || {}).some(value => String(value || "").trim());
    }
    function playerSignature(players = state.players) {
      return (players || []).map(name => String(name || "").trim().toLowerCase()).join("|");
    }
    function mergeVoorData(existingVoor = {}, incomingVoor = {}) {
      const merged = { ...(existingVoor || {}) };
      Object.entries(incomingVoor || {}).forEach(([key, value]) => {
        if (String(value || "").trim()) merged[key] = value;
      });
      return merged;
    }
    function readVoorBackup() {
      try {
        const raw = JSON.parse(localStorage.getItem(`${KEY}-voor-backup`) || "null");
        if (!raw) return {};
        if (raw.voor && raw.playersSig === playerSignature()) return raw.voor;
        if (raw.voor) return {};
        return raw;
      } catch { return {}; }
    }
    function persistVoorBackup() {
      if (!hasVoorData(state)) return;
      const merged = mergeVoorData(readVoorBackup(), state.voor);
      const payload = { playersSig: playerSignature(), voor: merged };
      localStorage.setItem(`${KEY}-voor-backup`, JSON.stringify(payload));
      sessionStorage.setItem(`${KEY}-voor-backup`, JSON.stringify(payload));
    }
    function cacheLiveState() {
      if (!LIVE_CACHE_KEY || !LIVE_CAN_EDIT) return;
      try {
        if (!hasVoorData(state)) {
          const cached = cachedLiveState();
          if (hasVoorData(cached)) {
            localStorage.setItem(LIVE_CACHE_KEY, JSON.stringify({ savedAt: new Date().toISOString(), state: { ...state, voor: cached.voor } }));
            return;
          }
        }
        localStorage.setItem(LIVE_CACHE_KEY, JSON.stringify({ savedAt: new Date().toISOString(), state }));
      } catch {}
    }
    function cachedLiveState() {
      if (!LIVE_CACHE_KEY) return null;
      try {
        return JSON.parse(localStorage.getItem(LIVE_CACHE_KEY) || "null")?.state || null;
      } catch {
        return null;
      }
    }
    async function pushLiveState(useKeepalive = false) {
      if (!LIVE_GAME_ID || !LIVE_CAN_EDIT || liveLoading) return false;
      const cached = cachedLiveState();
      if (hasVoorData(cached)) state.voor = mergeVoorData(cached.voor, state.voor);
      cacheLiveState();
      try {
        const options = {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ token: LIVE_EDIT_TOKEN, state })
        };
        if (useKeepalive) options.keepalive = true;
        const res = await fetch(liveApi("update"), options);
        const data = await res.json();
        if (data.ok) {
          liveLastUpdated = data.updated_at || liveLastUpdated;
          liveSaveStatus = "Live saved";
          return true;
        }
        liveSaveStatus = `Live save gagal: ${data.error || "unknown"}`;
        console.warn(liveSaveStatus);
        return false;
      } catch (err) {
        liveSaveStatus = "Live save gagal. Cek koneksi.";
        console.warn("Live save gagal.", err);
        return false;
      }
    }
    async function pushLiveSetup() {
      if (!LIVE_GAME_ID || !LIVE_CAN_EDIT || liveLoading) return false;
      const cached = cachedLiveState();
      if (hasVoorData(cached)) state.voor = mergeVoorData(cached.voor, state.voor);
      cacheLiveState();
      const payload = {
        token: LIVE_EDIT_TOKEN,
        players: state.players,
        rates: state.rates,
        startBanker: state.startBanker,
        useBacarat: state.useBacarat,
        activeFrom: state.activeFrom || {},
        inactiveFrom: state.inactiveFrom || {}
      };
      if (hasVoorData(state)) payload.voor = state.voor;
      try {
        const res = await fetch(liveApi("update_setup"), {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (data.ok) {
          liveLastUpdated = data.updated_at || liveLastUpdated;
          liveSaveStatus = "Setup saved";
          return true;
        }
        liveSaveStatus = `Setup save gagal: ${data.error || "unknown"}`;
        console.warn(liveSaveStatus);
        return false;
      } catch (err) {
        liveSaveStatus = "Setup save gagal. Cek koneksi.";
        console.warn("Setup save gagal.", err);
        return false;
      }
    }
    function save() {
      if (LIVE_GAME_ID) {
        if (!LIVE_CAN_EDIT || liveLoading) return;
        const cached = cachedLiveState();
        if (hasVoorData(cached)) state.voor = mergeVoorData(cached.voor, state.voor);
        const voorBackup = readVoorBackup();
        if (hasVoorObject(voorBackup)) state.voor = mergeVoorData(voorBackup, state.voor);
        cacheLiveState();
        clearTimeout(liveSaveTimer);
        liveSaveTimer = setTimeout(pushLiveState, 450);
        return;
      }
      try {
        const saved = JSON.parse(localStorage.getItem(KEY) || "null");
        if (hasVoorData(saved)) state.voor = mergeVoorData(saved.voor, state.voor);
        const voorBackup = readVoorBackup();
        if (hasVoorObject(voorBackup)) state.voor = mergeVoorData(voorBackup, state.voor);
      } catch {}
      localStorage.setItem(KEY, JSON.stringify(state));
      localStorage.setItem(`${KEY}-backup`, JSON.stringify({ savedAt: new Date().toISOString(), state }));
      persistVoorBackup();
    }
    function flushSave() {
      if (LIVE_GAME_ID && LIVE_CAN_EDIT && !liveLoading) {
        clearTimeout(liveSaveTimer);
        pushLiveState(false);
        return;
      }
      if (!LIVE_GAME_ID) save();
    }
    function saveSetupNow() {
      if (LIVE_GAME_ID && LIVE_CAN_EDIT) {
        pushLiveSetup();
        return;
      }
      save();
    }
    async function pullLiveState(forceRender = false) {
      if (!LIVE_GAME_ID) return false;
      try {
        const res = await fetch(liveApi("get"), { cache: "no-store" });
        const data = await res.json();
        if (!data.ok) {
          await uiAlert(data.error || "Game live tidak ditemukan.", { title: "Game tidak ditemukan", tone: "warn" });
          return false;
        }
        if (!forceRender && data.updated_at === liveLastUpdated) return true;
        liveLoading = true;
        liveLastUpdated = data.updated_at || "";
        const serverState = { ...defaultState(), ...(data.state || {}) };
        const cachedState = cachedLiveState();
        if (LIVE_CAN_EDIT && !hasVoorData(serverState) && hasVoorData(cachedState)) {
          serverState.voor = cachedState.voor;
          liveSaveStatus = "Voor dipulihkan dari backup lokal";
          setTimeout(() => pushLiveState(), 300);
        }
        state = serverState;
        ensure();
        syncInputs();
        liveLoading = false;
        if (forceRender) render();
        return true;
      } catch (err) {
        console.warn("Live load gagal.", err);
        liveLoading = false;
        return false;
      }
    }
    async function load() {
      if (LIVE_GAME_ID) {
        await pullLiveState(false);
        return;
      }
      state = defaultState();
      localStorage.removeItem(KEY);
      localStorage.removeItem(`${KEY}-voor-backup`);
      sessionStorage.removeItem(`${KEY}-voor-backup`);
      ensure();
      syncInputs();
    }
    function syncInputs() {
      document.documentElement.dataset.build = APP_BUILD;
      document.documentElement.dataset.liveMode = LIVE_GAME_ID ? LIVE_CAN_EDIT ? "edit" : "view" : "local";
      updateStickyOffset();
      updateShareWhatsapp();
      document.getElementById("front").value = state.front;
      document.getElementById("back").value = state.back;
    }
    function lastPlayableHole() {
      const lastDone = state.holes.reduce((last, hole, idx) => hole.completed ? idx : last, -1);
      return Math.max(0, lastDone >= 0 ? Math.min(lastDone + 1, roundHoles().length - 1) : state.active);
    }
    function render() {
      ensure();
      renderSetup();
      renderGame();
      document.getElementById("setupPanel").classList.toggle("hide", state.started && !state.editingSetup);
      document.getElementById("gamePanel").classList.toggle("hide", !state.started || state.editingSetup || state.showNineSummary || state.showFinalSummary);
      document.getElementById("nineSummaryPanel").classList.toggle("hide", state.editingSetup || !state.showNineSummary);
      document.getElementById("finalSummaryPanel").classList.toggle("hide", state.editingSetup || !state.showFinalSummary);
      document.getElementById("editSetup").classList.toggle("hide", !state.started);
      document.getElementById("viewBacarat").classList.toggle("hide", !state.useBacarat);
      document.getElementById("viewScoreCard").textContent = state.holes.length && state.holes.every(h => h.completed) ? "Final Score Card" : "Current Score Card";
      renderNineSummary();
      renderFinalSummary();
      if (LIVE_GAME_ID) {
        const h1 = document.querySelector("h1");
        if (h1 && !h1.dataset.liveLabel) {
          h1.dataset.liveLabel = "1";
          h1.textContent = `${h1.textContent} ${LIVE_CAN_EDIT ? "(Live Admin)" : "(Live View)"}`;
        }
      }
      save();
    }
    function updateShareWhatsapp() {
      const el = document.getElementById("shareWhatsapp");
      if (!el) return;
      if (!LIVE_GAME_ID) {
        el.classList.add("hide");
        el.removeAttribute("href");
        return;
      }
      const viewUrl = `${location.origin}/game.php?id=${encodeURIComponent(LIVE_GAME_ID)}`;
      const text = encodeURIComponent(`Live score GolfBangers:\n${viewUrl}`);
      el.href = `https://wa.me/?text=${text}`;
      el.classList.remove("hide");
    }
    function updateStickyOffset() {
      const header = document.querySelector("header");
      document.documentElement.style.setProperty("--sticky-offset", `${header?.offsetHeight || 0}px`);
    }
    function renderSetup() {
      const ns = names();
      document.getElementById("players").innerHTML = state.players.map((name, idx) => `
        <div class="player"><span class="num">${idx + 1}</span><input data-player="${idx}" value="${esc(name)}" placeholder="Nama player"><button type="button" class="btn-remove" data-remove-player="${idx}" aria-label="Hapus player ${idx + 1}" title="Hapus">×</button></div>
      `).join("");
      document.getElementById("startBanker").innerHTML = ns.map((n, i) => `<option value="${i}">${esc(n)}</option>`).join("");
      document.getElementById("startBanker").value = state.startBanker;
      document.getElementById("setupModeHint").textContent = state.editingSetup ? "Edit voor tanpa hapus score" : "Isi urut dari atas ke bawah";
      document.getElementById("startGame").textContent = state.editingSetup ? `Simpan perubahan & Lanjut ke Hole ${roundHoles()[lastPlayableHole()]?.global || 1}` : "Mulai Permainan";
      document.getElementById("startHelp").textContent = state.editingSetup ? "Perubahan voor akan dihitung ulang dari score yang sudah tersimpan. Data score tidak dihapus." : "Setelah mulai, layar utama dibuat seperti score card dan progress dibuka lewat tombol.";
      document.getElementById("useBacarat").checked = !!state.useBacarat;
      document.getElementById("startBankerWrap").classList.toggle("hide", !state.useBacarat);
      document.getElementById("rateSummary").innerHTML = `
        <b>Bangers Rule!</b>
        <span>1. Face to face: <b>Rp ${fmt.format(state.rates.f2f)}</b> / Hole</span>
        <span>2. Single winner: <b>Rp ${fmt.format(state.rates.winner)}</b> / Hole</span>
        ${state.useBacarat ? `<span>3. Bacarat: <b>Rp ${fmt.format(state.rates.bacarat)}</b> (Non Par 3) / <b>Rp. ${fmt.format(state.rates.bacaratPar3)}</b> (Par 3)</span>
        <span>- Player Bacarat x3</span>
        <span>- Bandar Bacarat x2</span>` : `<span>3. Bacarat: <b>Tidak dipakai ronde ini</b></span>`}
        <span>4. Winner (On Berdie): <b>Rp. ${fmt.format(state.rates.par3Bonus)}</b> / Hole</span>
        <span>Birdie x2, eagle x5, HIO x10</span>
        `;
      document.getElementById("matrix").innerHTML = `
        <table class="matrix-table">
          <thead><tr><th>Pemberi \\ Penerima</th>${ns.map(n => `<th>${esc(n)}</th>`).join("")}</tr></thead>
          <tbody>${ns.map((giver, gi) => `<tr><th>${esc(giver)}</th>${ns.map((_, ri) => gi === ri ? `<td>-</td>` : voorCell(gi, ri)).join("")}</tr>`).join("")}</tbody>
        </table>`;
    }
    function voorClass(value) {
      const clean = String(value || "").trim();
      if (!clean) return "voor-empty";
      if (clean.toLowerCase() === "skret") return "voor-skret";
      if (["x", "no-game", "nogame"].includes(clean.toLowerCase())) return "voor-nogame";
      return clean.startsWith("+") ? "voor-get" : "voor-give";
    }
    function voorCell(giver, receiver) {
      const key = `${giver}-${receiver}`;
      const value = formatVoor(state.voor[key] || "");
      return `<td><input class="small ${voorClass(value)}" data-voor="${key}" value="${esc(value)}" placeholder="Isi / Skret"></td>`;
    }
    function updateStartBankerLabels() {
      const select = document.getElementById("startBanker");
      names().forEach((name, idx) => {
        if (select.options[idx]) select.options[idx].textContent = name;
      });
    }
    function renderGame() {
      if (!state.started) return;
      const holes = roundHoles();
      const ns = names();
      const hole = holes[state.active];
      const entry = state.holes[state.active];
      const calcNow = calc(roundHoles().length - 1);
      const winners = holeWinners(state.active);
      const leaders = holeLeaders(state.active);
      const onBerdiePlayers = hole.par === 3
        ? activeIndexes(state.active).filter(player => Number(entry.scores[player]) === -1 && entry.onGreen?.[player])
        : [];
      const needsManualBanker = manualBankerRequired(state.active);
      const bankerReady = !needsManualBanker || entry.manualBanker;
      const bankerWarning = roundHoles()[state.active]?.par === 3
        ? "Par 3 wajib pilih bandar manual dahulu."
        : "Bandar draw, silakan pilih bandar manual dahulu.";
      const statusText = !holeComplete(state.active)
        ? "Score belum lengkap"
        : needsManualBanker && !entry.manualBanker
          ? bankerWarning
        : winners.length === 1
          ? `Winner: ${ns[winners[0]]}`
          : `No winner${leaders.length ? `: ${leaders.map(i => ns[i]).join(", ")}` : ""}`;
      const onBerdieStatus = hole.par === 3 && holeComplete(state.active)
        ? onBerdiePlayers.length === 1
          ? ` | On Berdie: ${ns[onBerdiePlayers[0]]}`
          : onBerdiePlayers.length > 1
            ? " | On Berdie: Draw"
            : ""
        : "";

      document.getElementById("startMessage").classList.toggle("hide", state.active !== 0 || state.holes.some(h => h.completed));
      document.getElementById("scoreCardTitle").textContent = `Score Card - ${hole.course} Course`;
      document.getElementById("holeTitle").textContent = `Hole ${hole.global} | ${displayDate()}`;
      document.getElementById("holes").innerHTML = holes.map((h, idx) => `
        <button class="hole-btn ${idx === state.active ? "active" : ""} ${state.holes[idx].completed ? "done" : ""}" data-hole="${idx}">
          <b>${h.roundNo}</b><span class="par-label">Par ${h.par}</span><span class="index-label">Index ${h.index}</span>
        </button>`).join("");
      document.getElementById("meta").innerHTML = `
        <div class="metric"><span>Course</span><b>${esc(hole.course)}</b></div>
        <div class="metric"><span>Hole</span><div class="metric-line"><b>${hole.roundNo}</b><button id="changeHole" class="soft">Ganti Hole</button></div></div>
        <div class="metric"><span>Par / Index</span><b>${hole.par} / ${hole.index}</b></div>
        ${state.useBacarat ? `<div class="metric"><span>Bandar ${needsManualBanker ? "(Wajib Manual)" : entry.manualBanker ? "(Manual)" : "(Auto)"}</span><div class="metric-line"><b>${bankerReady ? esc(ns[entry.banker]) : "Pilih manual"}</b><button id="changeBanker" class="soft">Ganti Bandar</button></div></div>` : `<div class="metric"><span>Bacarat</span><b>Tidak dipakai</b></div>`}`;
      document.getElementById("scoreTable").innerHTML = scoreTable(ns, hole, entry, calcNow, bankerReady);
      const liveText = LIVE_GAME_ID ? ` | ${LIVE_CAN_EDIT ? liveSaveStatus || "Live admin" : "Live view"}` : "";
      document.getElementById("status").textContent = `${entry.completed ? `Saved. ${statusText}${onBerdieStatus}` : statusText}${liveText}`;
    }
    function renderNineSummary() {
      if (!state.showNineSummary) return;
      const ns = names();
      const c = calc(8);
      const holes = roundHoles();
      const nextHole = holes[9];
      const nextBanker = state.holes[9]?.banker ?? state.holes[8]?.nextBanker ?? 0;
      document.getElementById("nineSummarySubtitle").textContent = `${displayDate()} | Selesai sampai Hole ${holes[8]?.global || 9}`;
      document.getElementById("nineCoffee").innerHTML = `<b>${esc(coffeeMessage() || "After 9 holes, coffee belum bisa ditentukan.")}</b>`;
      document.getElementById("nineGrossCard").innerHTML = nineHoleScorecardHtml(0, 8);
      document.getElementById("nineCards").innerHTML = ns.map((n, i) => `<div class="card"><strong>${esc(n)}</strong><div class="total">${signed(c.totals[i].total)}</div><p>F2F ${fmt.format(c.totals[i].f2f)} | Single Winner ${fmt.format(c.totals[i].winner)} | On-Berdie ${fmt.format(c.totals[i].birdie)}${state.useBacarat ? ` | Bacarat ${fmt.format(c.totals[i].bacarat)}` : ""}</p></div>`).join("");
      document.getElementById("nineNextBanker").innerHTML = `Bandar berikutnya: <b>${esc(ns[nextBanker])}</b>`;
      document.getElementById("continueAfterNine").textContent = nextHole ? `Lanjut ke Hole ${nextHole.global}` : "Lanjut";
    }
    function renderFinalSummary() {
      if (!state.showFinalSummary) return;
      document.getElementById("finalProgress").innerHTML = `<div class="hint"><b>Tanggal Game: ${displayDate()}</b></div>${progressHtml("total", { hideF2FDetail: true, hideCoffee: true })}`;
      document.getElementById("finalGrossCard").innerHTML = grossScorecardHtml(0, roundHoles().length - 1, true);
    }
    function grossScorecardHtml(startIdx, endIdx, showSplitTotals = false) {
      const allHoles = roundHoles();
      const visibleIndexes = allHoles.map((_, idx) => idx).filter(idx => idx >= startIdx && idx <= endIdx);
      const frontIndexes = visibleIndexes.filter(idx => idx < 9);
      const backIndexes = visibleIndexes.filter(idx => idx >= 9 && idx < 18);
      const extraIndexes = visibleIndexes.filter(idx => idx >= 18);
      const ns = names();
      const scoreCell = rel => {
        if (!Number.isFinite(rel)) return "";
        if (rel === -1) return `<span class="score-mark score-birdie">-1</span>`;
        if (rel <= -2) return `<span class="score-mark score-eagle">${rel}</span>`;
        return String(rel);
      };
      const segmentTotal = (player, from, to) => {
        let sum = 0;
        let count = 0;
        roundHoles().slice(from, to + 1).forEach((hole, offset) => {
          const idx = from + offset;
          const rel = Number(state.holes[idx]?.scores[player]);
          if (state.holes[idx]?.completed && isActive(player, idx) && Number.isFinite(rel)) {
            sum += hole.par + rel;
            count += 1;
          }
        });
        return count ? sum : "";
      };
      const holeHeaders = indexes => indexes.map(idx => `<th class="money scorecard-hole">${allHoles[idx].global}</th>`).join("");
      const scoreCells = (player, indexes) => indexes.map(idx => {
        const rel = Number(state.holes[idx]?.scores[player]);
        const relScore = state.holes[idx]?.completed && isActive(player, idx) && Number.isFinite(rel) ? rel : null;
        return `<td class="money scorecard-hole">${scoreCell(relScore)}</td>`;
      }).join("");
      const frontCourse = frontIndexes.length ? esc(allHoles[frontIndexes[0]].course) + " Course" : "";
      const backCourse = backIndexes.length ? esc(allHoles[backIndexes[0]].course) + " Course" : "";
      const extraCourses = [...new Set(extraIndexes.map(idx => allHoles[idx].course))];
      const holeCols = indexes => indexes.map(() => `<col class="scorecard-hole-col">`).join("");
      const crownEnabled = showSplitTotals && startIdx === 0 && endIdx >= 17 && state.holes.slice(0, 18).every(h => h.completed);
      const total18Values = crownEnabled ? ns.map((_, player) => Number(segmentTotal(player, 0, 17))).filter(Number.isFinite) : [];
      const lowestGross = total18Values.length ? Math.min(...total18Values) : null;
      const total18Cell = player => {
        const total = segmentTotal(player, 0, 17);
        if (lowestGross !== null && Number(total) === lowestGross) {
          return `<span class="gross-crown-wrap"><span>${total}</span><span class="gross-crown">♛</span></span>`;
        }
        return total;
      };
      const crownLegend = lowestGross !== null ? `<div class="scorecard-legend"><span class="gross-crown">♛</span>= Best Gross</div>` : "";
      const extraTotal = player => {
        let sum = 0;
        let count = 0;
        extraIndexes.forEach(idx => {
          const rel = Number(state.holes[idx]?.scores[player]);
          if (state.holes[idx]?.completed && isActive(player, idx) && Number.isFinite(rel)) {
            sum += allHoles[idx].par + rel;
            count += 1;
          }
        });
        return count ? sum : "";
      };
      const extraTable = extraIndexes.length ? `<div class="scorecard-course-note">Course tambahan tidak digabung ke tabel 18 holes agar tetap nyaman dibaca.</div>
        <table class="scorecard-table">
          <colgroup><col class="scorecard-name-col">${holeCols(extraIndexes)}<col class="scorecard-total-col"></colgroup>
          <thead>
            <tr><th rowspan="2" class="scorecard-name">Hole</th><th class="scorecard-course" colspan="${extraIndexes.length}">${extraCourses.map(course => `${esc(course)} Course`).join(" - ")}</th><th rowspan="2" class="money score-total-col scorecard-total">Extra Gross</th></tr>
            <tr>${holeHeaders(extraIndexes)}</tr>
          </thead>
          <tbody>${ns.map((name, player) => `<tr><td class="scorecard-name"><b>${esc(name)}</b></td>${scoreCells(player, extraIndexes)}<td class="money score-total-col scorecard-total">${extraTotal(player)}</td></tr>`).join("")}</tbody>
        </table>` : "";
      const splitTable = (indexes, courseTitle, totalLabel, totalFrom, totalTo, includeGrand = false, extraClass = "") => {
        if (!indexes.length) return "";
        return `<div class="scorecard-split ${extraClass}">
          <table class="scorecard-table">
            <colgroup><col class="scorecard-name-col">${holeCols(indexes)}${showSplitTotals ? `<col class="scorecard-total-col">${includeGrand ? `<col class="scorecard-total-col">` : ""}` : ""}</colgroup>
            <thead>
              <tr><th rowspan="2" class="scorecard-name">Hole</th><th class="scorecard-course" colspan="${indexes.length}">${courseTitle}</th>${showSplitTotals ? `<th rowspan="2" class="money score-total-col scorecard-total">${totalLabel}</th>${includeGrand ? `<th rowspan="2" class="money score-grand-col scorecard-total">T18</th>` : ""}` : ""}</tr>
              <tr>${holeHeaders(indexes)}</tr>
            </thead>
            <tbody>${ns.map((name, player) => `<tr>
              <td class="scorecard-name"><b>${esc(name)}</b></td>
              ${scoreCells(player, indexes)}
              ${showSplitTotals ? `<td class="money score-total-col scorecard-total">${segmentTotal(player, totalFrom, totalTo)}</td>${includeGrand ? `<td class="money score-grand-col scorecard-total">${total18Cell(player)}</td>` : ""}` : ""}
            </tr>`).join("")}</tbody>
          </table>
        </div>`;
      };
      const wideTable = `<div class="scorecard-wide"><table class="scorecard-table">
        <colgroup><col class="scorecard-name-col">${holeCols(frontIndexes)}${showSplitTotals && frontIndexes.length ? `<col class="scorecard-total-col">` : ""}${holeCols(backIndexes)}${showSplitTotals && backIndexes.length ? `<col class="scorecard-total-col"><col class="scorecard-total-col">` : ""}</colgroup>
        <thead>
          <tr>
            <th rowspan="2" class="scorecard-name">Hole</th>
            ${frontIndexes.length ? `<th class="scorecard-course" colspan="${frontIndexes.length}">${frontCourse}</th>` : ""}
            ${showSplitTotals && frontIndexes.length ? `<th rowspan="2" class="money score-total-col scorecard-total">F9</th>` : ""}
            ${backIndexes.length ? `<th class="scorecard-course" colspan="${backIndexes.length}">${backCourse}</th>` : ""}
            ${showSplitTotals && backIndexes.length ? `<th rowspan="2" class="money score-total-col scorecard-total">B9</th><th rowspan="2" class="money score-grand-col scorecard-total">T18</th>` : ""}
          </tr>
          <tr>${holeHeaders(frontIndexes)}${holeHeaders(backIndexes)}</tr>
        </thead>
        <tbody>${ns.map((name, player) => `<tr>
          <td class="scorecard-name"><b>${esc(name)}</b></td>
          ${scoreCells(player, frontIndexes)}
          ${showSplitTotals && frontIndexes.length ? `<td class="money score-total-col scorecard-total">${segmentTotal(player, 0, 8)}</td>` : ""}
          ${scoreCells(player, backIndexes)}
          ${showSplitTotals && backIndexes.length ? `<td class="money score-total-col scorecard-total">${segmentTotal(player, 9, 17)}</td><td class="money score-grand-col scorecard-total">${total18Cell(player)}</td>` : ""}
        </tr>`).join("")}</tbody>
      </table></div>`;
      const stackedTables = `<div class="scorecard-stack">${splitTable(frontIndexes, frontCourse, "F9", 0, 8, false, "one-total")}${splitTable(backIndexes, backCourse, "B9", 9, 17, true)}${extraTable}</div>`;
      return `${wideTable}${stackedTables}${extraTable ? `<div class="scorecard-wide">${extraTable}</div>` : ""}${crownLegend}`;
    }
    function nineHoleScorecardHtml(startIdx, endIdx) {
      const allHoles = roundHoles();
      const indexes = allHoles.map((_, idx) => idx).filter(idx => idx >= startIdx && idx <= endIdx);
      const ns = names();
      const courseTitle = indexes.length ? `${esc(allHoles[indexes[0]].course)} Course` : "Course";
      const scoreCell = rel => {
        if (!Number.isFinite(rel)) return "";
        if (rel === -1) return `<span class="score-mark score-birdie">-1</span>`;
        if (rel <= -2) return `<span class="score-mark score-eagle">${rel}</span>`;
        return String(rel);
      };
      const totalGross = player => {
        let sum = 0;
        let count = 0;
        indexes.forEach(idx => {
          const rel = Number(state.holes[idx]?.scores[player]);
          if (state.holes[idx]?.completed && isActive(player, idx) && Number.isFinite(rel)) {
            sum += allHoles[idx].par + rel;
            count += 1;
          }
        });
        return count ? sum : "";
      };
      const holeCols = indexes.map(() => `<col class="scorecard-hole-col">`).join("");
      const holeHeaders = indexes.map(idx => `<th class="money scorecard-hole">${allHoles[idx].global}</th>`).join("");
      const scoreCells = (player) => indexes.map(idx => {
        const rel = Number(state.holes[idx]?.scores[player]);
        const relScore = state.holes[idx]?.completed && isActive(player, idx) && Number.isFinite(rel) ? rel : null;
        return `<td class="money scorecard-hole">${scoreCell(relScore)}</td>`;
      }).join("");
      return `<div class="scorecard-split one-total nine-only">
        <table class="scorecard-table">
          <colgroup><col class="scorecard-name-col">${holeCols}<col class="scorecard-total-col"></colgroup>
          <thead>
            <tr><th rowspan="2" class="scorecard-name">Hole</th><th class="scorecard-course" colspan="${indexes.length}">${courseTitle}</th><th rowspan="2" class="money score-total-col scorecard-total">F9</th></tr>
            <tr>${holeHeaders}</tr>
          </thead>
          <tbody>${ns.map((name, player) => `<tr><td class="scorecard-name"><b>${esc(name)}</b></td>${scoreCells(player)}<td class="money score-total-col scorecard-total">${totalGross(player)}</td></tr>`).join("")}</tbody>
        </table>
      </div>`;
    }
    function currentScorecardHtml() {
      const lastCompleted = state.holes.reduce((last, hole, idx) => hole.completed ? idx : last, -1);
      const endIdx = state.holes.every(h => h.completed) ? roundHoles().length - 1 : Math.max(lastCompleted, state.active);
      const title = state.holes.length && state.holes.every(h => h.completed) ? "Final Score Card" : "Current Score Card";
      return `<div class="hint"><b>${title}</b><br>${displayDate()} | Score per hole relatif terhadap par. Total Front/Back/18 adalah gross stroke.</div>
        <div class="table">${grossScorecardHtml(0, endIdx, true)}</div>`;
    }
    function scoreTable(ns, hole, entry, calcNow, bankerReady = true) {
      const bankerIdx = bankerReady ? entry.banker : -1;
      const onGreenHead = hole.par === 3 ? "<th>On Green?</th>" : "";
      const head = state.useBacarat
        ? `<th>Player Call</th><th>Bandar Call</th>`
        : "";
      return `<table class="score-table">
        <thead><tr><th>Player</th><th>Score +/- Par</th>${onGreenHead}${head}<th class="money">Total Running</th></tr></thead>
        <tbody>${ns.map((name, idx) => {
          if (!isActive(idx, state.active)) {
            const startAt = Number(state.activeFrom?.[idx] ?? 0);
            const pendingStart = state.active < startAt;
            const label = pendingStart ? "Belum mulai" : "Tidak lanjut";
            const startHole = roundHoles()[startAt]?.roundNo || startAt + 1;
            const note = pendingStart ? `Golfer mulai dihitung dari Hole ${startHole}.` : "Golfer tidak ikut perhitungan mulai hole ini.";
            return `<tr><td><b>${esc(name)}</b> <span class="pill bad">${label}</span></td><td data-label="Status" colspan="${(state.useBacarat ? 3 : 1) + (hole.par === 3 ? 1 : 0)}" class="muted">${note}</td><td data-label="Total" class="money">${signed(calcNow.totals[idx].total)}</td></tr>`;
          }
          const bet = entry.baccarat[idx];
          const scoreValue = Number(entry.scores[idx]);
          const onGreenCell = hole.par === 3
            ? `<td data-label="On Green?">${scoreValue === -1 ? `<label class="checkline"><input type="checkbox" data-on-green="${idx}" ${entry.onGreen?.[idx] ? "checked" : ""}> Ya</label>` : "-"}</td>`
            : "";
          const bacaratCells = state.useBacarat ? `
            <td data-label="Player Call">${idx === bankerIdx ? "-" : `<select class="small" data-pm="${idx}"><option value="1" ${bet.playerMult == 1 ? "selected" : ""}>x1</option><option value="2" ${bet.playerMult == 2 ? "selected" : ""}>x2</option><option value="3" ${bet.playerMult == 3 ? "selected" : ""}>x3</option></select>`}</td>
            <td data-label="Bandar Call">${idx === bankerIdx ? `<select class="small" data-hole-bm><option value="1" ${Number(entry.bankerMult || 1) === 1 ? "selected" : ""}>x1</option><option value="2" ${Number(entry.bankerMult || 1) === 2 ? "selected" : ""}>x2</option></select>` : "-"}</td>` : "";
          return `<tr>
            <td><b>${esc(name)}</b> ${state.useBacarat && idx === bankerIdx ? `<span class="pill warn">Bandar</span>` : ""}</td>
            <td data-label="Score"><input class="score" type="number" min="-5" max="10" data-score="${idx}" value="${esc(entry.scores[idx])}"></td>
            ${onGreenCell}
            ${bacaratCells}
            <td data-label="Total" class="money">${signed(calcNow.totals[idx].total)}</td>
          </tr>`;
        }).join("")}</tbody>
      </table>`;
    }
    function progressHtml(mode, options = {}) {
      const ns = names();
      const c = calc(roundHoles().length - 1);
      const moneyClass = amount => amount > 0 ? "positive" : amount < 0 ? "negative" : "";
      const rankedTotals = [...new Set(c.totals.map(t => t.total).sort((a, b) => b - a))];
      const leaderTotal = rankedTotals[0] ?? 0;
      const secondTotal = rankedTotals[1];
      const lastTotal = rankedTotals[rankedTotals.length - 1] ?? 0;
      const rankBadge = i => {
        const total = c.totals[i].total;
        if (total === leaderTotal) return `<span class="rank-badge rank-gold">1st Leader</span>`;
        if (secondTotal !== undefined && total === secondTotal) return `<span class="rank-badge rank-silver">2nd</span>`;
        if (rankedTotals.length >= 3 && total === lastTotal) return `<span class="rank-badge rank-spirit">Semangat ya! :)</span>`;
        return "";
      };
      const summaryBreakdown = i => `
        <div class="breakdown">
          <div class="breakdown-row"><span>F2F</span><b class="${moneyClass(c.totals[i].f2f)}">${signed(c.totals[i].f2f)}</b></div>
          <div class="breakdown-row"><span>Single Winner</span><b class="${moneyClass(c.totals[i].winner)}">${signed(c.totals[i].winner)}</b></div>
          <div class="breakdown-row"><span>On Berdie</span><b class="${moneyClass(c.totals[i].birdie)}">${signed(c.totals[i].birdie)}</b></div>
          ${state.useBacarat ? `<div class="breakdown-row"><span>Bacarat</span><b class="${moneyClass(c.totals[i].bacarat)}">${signed(c.totals[i].bacarat)}</b></div>` : ""}
        </div>`;
      if (mode === "bacarat") {
        if (!state.useBacarat) return `<div class="hint"><b>Bacarat tidak dipakai di ronde ini.</b></div>`;
        return `<div class="table"><table><thead><tr><th>Player</th><th class="money">Bacarat</th><th class="money">Total Semua</th></tr></thead><tbody>${ns.map((n, i) => `<tr><td><b>${esc(n)}</b></td><td class="money">${signed(c.totals[i].bacarat)}</td><td class="money">${signed(c.totals[i].total)}</td></tr>`).join("")}</tbody></table></div>`;
      }
      const f2fRows = c.ledger.filter(r => r.type === "Face to face").map(r => `<tr><td>${r.hole}</td><td>${esc(ns[r.win])}</td><td>${esc(ns[r.lose])}</td><td class="money">Rp ${fmt.format(r.amount)}</td><td>${esc(r.note)}</td></tr>`).join("");
      const f2fDetail = options.hideF2FDetail ? "" : `
        <h2>Detail Face to Face</h2>
        <div class="table"><table><thead><tr><th>Hole</th><th>Winner</th><th>Loser</th><th class="money">Amount</th><th>Note</th></tr></thead><tbody>${f2fRows || `<tr><td colspan="5">Belum ada data F2F tersimpan.</td></tr>`}</tbody></table></div>`;
      const showCoffee = !options.hideCoffee && calcCompletedThrough(17) < 18 && coffeeMessage();
      return `${showCoffee ? `<div class="hint"><b>${esc(showCoffee)}</b></div>` : ""}
        <div class="cards">${ns.map((n, i) => `<div class="card"><strong>${esc(n)}</strong><div class="total ${moneyClass(c.totals[i].total)}">${signed(c.totals[i].total)}</div>${summaryBreakdown(i)}${rankBadge(i)}</div>`).join("")}</div>
        ${f2fDetail}`;
    }
    function ledgerHtml(filterPlayer = "all") {
      const ns = names();
      const filter = filterPlayer === "all" ? "all" : Number(filterPlayer);
      const rows = calc(roundHoles().length - 1).ledger
        .filter(r => filter === "all" || r.win === filter || r.lose === filter);
      return `<label>Tampilkan golfer
          <select id="ledgerFilter"><option value="all" ${filter === "all" ? "selected" : ""}>Semua golfer</option>${ns.map((n, i) => `<option value="${i}" ${filter === i ? "selected" : ""}>${esc(n)}</option>`).join("")}</select>
        </label>
        <div class="table"><table><thead><tr><th>Hole</th><th>Event</th><th>Winner</th><th>Loser</th><th class="money">Amount</th><th>Note</th></tr></thead><tbody>${rows.length ? rows.map(r => `<tr><td>${r.hole}</td><td>${esc(r.type)}</td><td>${esc(ns[r.win])}</td><td>${esc(ns[r.lose])}</td><td class="money">Rp ${fmt.format(r.amount)}</td><td>${esc(r.note)}</td></tr>`).join("") : `<tr><td colspan="6">Belum ada data ledger untuk golfer ini.</td></tr>`}</tbody></table></div>`;
    }
    function openModal(title, html) {
      document.getElementById("modalTitle").textContent = title;
      document.getElementById("modalBody").innerHTML = html;
      document.getElementById("modal").classList.add("show");
    }
    function ratesFormHtml() {
      return `<div class="grid2">
        <label>Face to face / Hole
          <input type="number" min="0" step="10000" data-rate="f2f" value="${state.rates.f2f}">
        </label>
        <label>Single winner / Hole
          <input type="number" min="0" step="10000" data-rate="winner" value="${state.rates.winner}">
        </label>
        <label>Bacarat Non Par 3
          <input type="number" min="0" step="10000" data-rate="bacarat" value="${state.rates.bacarat}">
        </label>
        <label>Bacarat Par 3
          <input type="number" min="0" step="10000" data-rate="bacaratPar3" value="${state.rates.bacaratPar3}">
        </label>
        <label>Winner (On Berdie)
          <input type="number" min="0" step="10000" data-rate="par3Bonus" value="${state.rates.par3Bonus}">
        </label>
      </div>
      <div class="row"><button id="saveRates" class="primary">Simpan Rates</button></div>
      <div class="hint">Default sudah siap dipakai. Ubah hanya kalau nominal hari itu berbeda.</div>`;
    }
    function stopGolferHtml() {
      const ns = names();
      const active = activeIndexes(state.active);
      return `<label>Pilih golfer
        <select id="stopGolferSelect">${active.map(idx => `<option value="${idx}">${esc(ns[idx])}</option>`).join("")}</select>
      </label>
      <label>Hole terakhir yang tercatat
        <select id="stopLastHoleSelect">${roundHoles().map((hole, idx) => `<option value="${idx}" ${idx === Math.max(0, state.active - 1) ? "selected" : ""}>Hole ${hole.roundNo} - ${esc(hole.course)}</option>`).join("")}</select>
      </label>
      <div class="hint">Golfer tetap dihitung sampai hole terakhir yang dipilih. Mulai hole setelahnya tidak ikut perhitungan.</div>
      <div class="row"><button id="confirmStopGolfer" class="primary">Set Golfer Tidak Lanjut</button></div>`;
    }
    function changeBankerHtml() {
      const ns = names();
      const manualOnly = manualBankerRequired(state.active);
      const par3Manual = roundHoles()[state.active]?.par === 3;
      return `<label>Pilih bandar hole aktif
        <select id="changeBankerSelect">${activeIndexes(state.active).map(idx => `<option value="${idx}" ${state.holes[state.active].banker === idx ? "selected" : ""}>${esc(ns[idx])}</option>`).join("")}</select>
      </label>
      <div class="hint">${manualOnly ? par3Manual ? "Hole Par 3 wajib pilih bandar manual hasil undian. Tidak ada pilihan auto untuk Par 3." : "Bandar draw, silakan pilih bandar manual untuk hole ini." : "Perubahan manual hanya untuk hole aktif dan tidak akan ditimpa otomatis. Kalau ingin ikut rule auto lagi, pakai tombol Pakai Auto."}</div>
      <div class="row"><button id="confirmChangeBanker" class="primary">Simpan Bandar Manual</button>${manualOnly ? "" : `<button id="resetAutoBanker">Pakai Auto</button>`}</div>`;
    }
    function autoBankerForHole(holeIdx) {
      if (holeIdx <= 0) return state.startBanker;
      return nextBankerAfter(holeIdx - 1).banker;
    }
    function changeHoleHtml() {
      return `<label>Pilih hole
        <select id="changeHoleSelect">${roundHoles().map((hole, idx) => `<option value="${idx}" ${state.active === idx ? "selected" : ""}>Hole ${hole.roundNo} - ${esc(hole.course)} | Par ${hole.par} | Index ${hole.index}</option>`).join("")}</select>
      </label>
      <div class="hint">Gunakan ini untuk kembali mengoreksi score atau bacarat yang salah entry.</div>
      <div class="row"><button id="confirmChangeHole" class="primary">Ganti Hole</button></div>`;
    }
    function removePlayer(index) {
      if (state.players.length <= 2) return;
      state.players.splice(index, 1);
      const nextVoor = {};
      Object.entries(state.voor).forEach(([key, value]) => {
        const [g, r] = key.split("-").map(Number);
        if (g === index || r === index) return;
        const ng = g > index ? g - 1 : g;
        const nr = r > index ? r - 1 : r;
        nextVoor[`${ng}-${nr}`] = value;
      });
      state.voor = nextVoor;
      const nextActive = {};
      Object.entries(state.activeFrom || {}).forEach(([player, hole]) => {
        const p = Number(player);
        if (p === index) return;
        nextActive[p > index ? p - 1 : p] = hole;
      });
      state.activeFrom = nextActive;
      const nextInactive = {};
      Object.entries(state.inactiveFrom || {}).forEach(([player, hole]) => {
        const p = Number(player);
        if (p === index) return;
        nextInactive[p > index ? p - 1 : p] = hole;
      });
      state.inactiveFrom = nextInactive;
      if (state.startBanker === index) state.startBanker = 0;
      else if (state.startBanker > index) state.startBanker -= 1;
    }
    function addPlayer() {
      if (state.players.length >= 8) return;
      const index = state.players.length;
      state.players.push("");
      if (state.started) {
        state.activeFrom = state.activeFrom || {};
        state.activeFrom[index] = lastPlayableHole();
      }
    }
    function normalizeVoorInput(key, rawValue) {
      const value = String(rawValue || "").trim();
      const [giver, receiver] = key.split("-").map(Number);
      if (!value || value === "0" || value.toLowerCase() === "skret") {
        state.voor[key] = "Skret";
        state.voor[`${receiver}-${giver}`] = "Skret";
        return true;
      }
      if (["x", "no-game", "nogame"].includes(value.toLowerCase())) {
        state.voor[key] = "No-Game";
        state.voor[`${receiver}-${giver}`] = "No-Game";
        return true;
      }
      if (value.startsWith("+")) {
        const clean = formatVoor(value.slice(1).trim());
        if (!parseVoor(clean).count) return null;
        state.voor[key] = `+${clean}`;
        state.voor[`${receiver}-${giver}`] = clean;
        return true;
      }
      if (parseVoor(value).count) {
        const clean = formatVoor(value);
        state.voor[key] = clean;
        state.voor[`${receiver}-${giver}`] = `+${clean}`;
        return true;
      }
      return null;
    }
    function applyVoorMirror(key, rawValue) {
      const value = String(rawValue || "").trim();
      const [giver, receiver] = key.split("-").map(Number);
      const mirrorKey = `${receiver}-${giver}`;
      let mirrorValue = null;
      if (!value) return;
      if (value.toLowerCase() === "skret" || value === "0") {
        state.voor[key] = "Skret";
        mirrorValue = "Skret";
      } else if (["x", "no-game", "nogame"].includes(value.toLowerCase())) {
        state.voor[key] = "No-Game";
        mirrorValue = "No-Game";
      } else if (value.startsWith("+")) {
        const clean = formatVoor(value.slice(1).trim());
        if (!parseVoor(clean).count) return;
        state.voor[key] = `+${clean}`;
        mirrorValue = clean;
      } else if (parseVoor(value).count) {
        const clean = formatVoor(value);
        state.voor[key] = clean;
        mirrorValue = `+${clean}`;
      } else {
        return;
      }
      state.voor[mirrorKey] = mirrorValue;
      const mirrorInput = document.querySelector(`[data-voor="${mirrorKey}"]`);
      if (mirrorInput && document.activeElement !== mirrorInput) {
        mirrorInput.value = mirrorValue;
        mirrorInput.classList.remove("voor-empty", "voor-get", "voor-give", "voor-skret", "voor-nogame");
        mirrorInput.classList.add(voorClass(mirrorValue));
      }
    }
    async function completeCurrentHole() {
      const entry = state.holes[state.active];
      const scores = entry.scores.map(Number);
      if (manualBankerRequired(state.active) && !entry.manualBanker) {
        await uiAlert(
          roundHoles()[state.active]?.par === 3
            ? "Hole Par 3 wajib memilih bandar secara manual dahulu."
            : "Bandar draw, silakan pilih bandar secara manual dahulu.",
          { title: "Pilih bandar dulu", tone: "warn" }
        );
        openModal("Ganti Bandar", changeBankerHtml());
        return;
      }
      if (!activeIndexes(state.active).every(player => Number.isFinite(scores[player]))) {
        await uiAlert("Score semua player yang masih lanjut harus diisi dulu.", { title: "Score belum lengkap" });
        return;
      }
      const hole = roundHoles()[state.active];
      const par3Birdies = activeIndexes(state.active).filter(player => scores[player] === -1);
      if (hole?.par === 3 && par3Birdies.length && !par3Birdies.some(player => entry.onGreen?.[player])) {
        const namesText = par3Birdies.map(player => names()[player]).join(", ");
        const ok = await uiConfirm(
          `${namesText} score birdie di Par 3, tapi belum dicentang On Green.\n\nApakah benar bukan On-Berdie?`,
          { title: "Cek On-Berdie", okText: "Ya, lanjut", cancelText: "Kembali" }
        );
        if (!ok) return;
      }
      const next = nextBankerAfter(state.active);
      entry.completed = true;
      entry.nextBanker = next.banker;
      recalcBankersFrom(state.active);
      if (state.active === 8) {
        state.showNineSummary = true;
      } else if (state.active === roundHoles().length - 1) {
        state.showFinalSummary = true;
      } else if (state.active < roundHoles().length - 1) {
        state.active += 1;
      }
      render();
      if (LIVE_GAME_ID && LIVE_CAN_EDIT) {
        const ok = await pushLiveState();
        if (!ok) await uiAlert(liveSaveStatus || "Live save gagal.", { title: "Gagal menyimpan", tone: "warn" });
      }
    }
    function recalcBankersFrom(startIdx) {
      const holes = roundHoles();
      for (let idx = startIdx; idx < holes.length - 1; idx++) {
        if (!state.holes[idx].completed) break;
        const next = nextBankerAfter(idx);
        state.holes[idx].nextBanker = next.banker;
        const nextHole = state.holes[idx + 1];
        if (!nextHole.manualBanker) {
          nextHole.needsManualBanker = !!next.manualRequired;
          if (!manualBankerRequired(idx + 1)) nextHole.banker = next.banker;
        }
      }
    }
    function blockViewerEdit(e) {
      if (!LIVE_GAME_ID || LIVE_CAN_EDIT) return;
      if (e.target.closest?.("#uiDialog")) return;
      const target = e.target;
      const button = target.closest?.("button");
      const allowedButtons = new Set([
        "viewTotal", "viewBacarat", "viewMatchplay", "viewScoreCard", "viewLedger",
        "closeModal", "finalMatchplay", "uiDialogOk", "uiDialogCancel"
      ]);
      if (button && allowedButtons.has(button.id)) return;
      if (target.id === "matchplayFilter" || target.id === "ledgerFilter") return;
      if (button || target.matches?.("input, select, textarea")) {
        e.preventDefault();
        e.stopPropagation();
        uiAlert("Mode view-only. Untuk edit score gunakan link admin.", {
          title: "View only",
          kicker: "Akses terbatas"
        });
      }
    }

    document.addEventListener("click", blockViewerEdit, true);
    document.addEventListener("input", blockViewerEdit, true);
    document.addEventListener("change", blockViewerEdit, true);
    document.addEventListener("input", e => {
      const t = e.target;
      if (t.dataset.player) {
        if (!state.started && state.players[Number(t.dataset.player)] !== t.value) {
          state.voor = {};
          localStorage.removeItem(`${KEY}-voor-backup`);
          sessionStorage.removeItem(`${KEY}-voor-backup`);
          document.querySelectorAll("[data-voor]").forEach(input => {
            input.value = "";
            input.classList.remove("voor-get", "voor-give", "voor-skret", "voor-nogame");
            input.classList.add("voor-empty");
          });
        }
        state.players[Number(t.dataset.player)] = t.value;
        updateStartBankerLabels();
        saveSetupNow();
        return;
      }
      if (t.dataset.voor) {
        const rawVoor = String(t.value || "").trim();
        const savableVoor = !rawVoor || rawVoor === "0" || ["skret", "x", "no-game", "nogame"].includes(rawVoor.toLowerCase()) || (rawVoor.startsWith("+") ? !!parseVoor(rawVoor.slice(1).trim()).count : !!parseVoor(rawVoor).count);
        if (!savableVoor) return;
        state.voor[t.dataset.voor] = t.value;
        t.classList.remove("voor-empty", "voor-get", "voor-give", "voor-skret", "voor-nogame");
        t.classList.add(voorClass(t.value));
        applyVoorMirror(t.dataset.voor, t.value);
        persistVoorBackup();
        saveSetupNow();
        return;
      }
      if (t.dataset.score) {
        if (t.dataset.typedScore !== "true" && t.dataset.lastScoreValue === "" && t.value === "1") {
          t.value = "0";
        }
        const playerIdx = Number(t.dataset.score);
        state.holes[state.active].scores[playerIdx] = t.value;
        if (Number(t.value) !== -1) state.holes[state.active].onGreen[playerIdx] = false;
        state.holes[state.active].completed = false;
        recalcBankersFrom(state.active);
        t.dataset.lastScoreValue = t.value;
        delete t.dataset.typedScore;
        save();
        return;
      }
      if (t.dataset.rate) {
        state.rates[t.dataset.rate] = Number(t.value || 0);
        saveSetupNow();
        return;
      }
    });
    document.addEventListener("beforeinput", e => {
      const t = e.target;
      if (t?.dataset?.score && e.inputType?.startsWith("insert")) {
        t.dataset.typedScore = "true";
      }
    });
    document.addEventListener("focusin", e => {
      const t = e.target;
      if (t?.dataset?.score) t.dataset.lastScoreValue = t.value;
    });
    document.addEventListener("keyup", e => {
      const t = e.target;
      if (t?.dataset?.voor) {
        applyVoorMirror(t.dataset.voor, t.value);
        persistVoorBackup();
        saveSetupNow();
      }
    });
    document.addEventListener("focusout", async e => {
      const t = e.target;
      if (t?.dataset?.voor) {
        const normalized = normalizeVoorInput(t.dataset.voor, t.value);
        if (normalized === null) {
          await uiAlert(
            "Input voor tidak valid.\nGunakan angka seperti 1 atau 2, +1 atau +2, 0/kosong untuk Skret, atau x untuk No-Game.",
            { title: "Voor tidak valid" }
          );
          normalizeVoorInput(t.dataset.voor, "");
          render();
          return;
        }
        if (normalized) {
          persistVoorBackup();
          saveSetupNow();
          render();
        }
      }
    });
    document.addEventListener("pointerdown", e => {
      const t = e.target;
      if (!t?.dataset?.score || t.value !== "") return;
      const rect = t.getBoundingClientRect();
      const inSpinnerArea = e.clientX >= rect.right - 24;
      if (!inSpinnerArea) return;
      e.preventDefault();
      t.focus();
      t.value = e.clientY < rect.top + rect.height / 2 ? "0" : "-1";
      t.dispatchEvent(new Event("input", { bubbles: true }));
    });
    document.addEventListener("keydown", e => {
      const t = e.target;
      if (!t?.dataset?.score || t.value !== "") return;
      if (e.key === "ArrowUp") {
        e.preventDefault();
        t.value = "0";
        t.dispatchEvent(new Event("input", { bubbles: true }));
      }
      if (e.key === "ArrowDown") {
        e.preventDefault();
        t.value = "-1";
        t.dispatchEvent(new Event("input", { bubbles: true }));
      }
    });
    document.addEventListener("change", async e => {
      const t = e.target;
      if (t.dataset.voor) {
        const normalized = normalizeVoorInput(t.dataset.voor, t.value);
        if (normalized === null) {
          await uiAlert(
            "Input voor tidak valid.\nGunakan angka seperti 1 atau 2, +1 atau +2, 0/kosong untuk Skret, atau x untuk No-Game.",
            { title: "Voor tidak valid" }
          );
          normalizeVoorInput(t.dataset.voor, "");
          render();
          return;
        }
        if (normalized) {
          persistVoorBackup();
          saveSetupNow();
          render();
        }
        return;
      }
      if (t.dataset.player || t.dataset.voor || t.dataset.score) {
        render();
        return;
      }
      if (t.dataset.onGreen !== undefined) {
        state.holes[state.active].onGreen[Number(t.dataset.onGreen)] = t.checked;
        state.holes[state.active].completed = false;
        save();
        render();
        return;
      }
      if (t.id === "front" || t.id === "back") {
        if (state.started) {
          await uiAlert(
            "Course tidak bisa diganti setelah game berjalan agar score yang sudah tersimpan tidak kacau.",
            { title: "Course terkunci", tone: "warn" }
          );
          syncInputs();
          return;
        }
        const prevFront = state.front;
        const prevBack = state.back;
        state[t.id] = t.value;
        normalizeCoursePair(t.id);
        if (state.front === state.back) {
          const courseName = COURSE[state.front]?.name || state.front;
          const ok = await uiConfirm(
            `Apakah benar ${courseName} Course akan dimainkan sebanyak 2x?`,
            { title: "Course sama 2x", okText: "Ya, lanjut", cancelText: "Batal" }
          );
          if (!ok) {
            state.front = prevFront;
            state.back = prevBack;
            syncInputs();
            return;
          }
        }
        state.active = 0;
        state.holes = [];
      }
      if (t.id === "startBanker") {
        state.startBanker = Number(t.value);
        if (state.holes[0] && !state.holes[0].manualBanker) state.holes[0].banker = state.startBanker;
      }
      if (t.id === "useBacarat") {
        state.useBacarat = t.checked;
        state.holes.forEach(h => {
          if (!state.useBacarat) h.needsManualBanker = false;
        });
      }
      if (t.dataset.currentBanker !== undefined) {
        state.holes[state.active].banker = Number(t.value);
        state.holes[state.active].manualBanker = true;
        state.holes[state.active].completed = false;
      }
      if (t.dataset.play) state.holes[state.active].baccarat[Number(t.dataset.play)].play = t.value === "true";
      if (t.dataset.pm) state.holes[state.active].baccarat[Number(t.dataset.pm)].playerMult = Number(t.value);
      if (t.dataset.bm) state.holes[state.active].baccarat[Number(t.dataset.bm)].bankerMult = Number(t.value);
      if (t.dataset.holeBm !== undefined) state.holes[state.active].bankerMult = Number(t.value);
      if (t.id === "matchplayFilter") {
        document.getElementById("modalBody").innerHTML = matchplayHtml(t.value);
        return;
      }
      if (t.id === "ledgerFilter") {
        document.getElementById("modalBody").innerHTML = ledgerHtml(t.value);
        return;
      }
      render();
    });
    document.addEventListener("click", async e => {
      if (e.target.closest("#uiDialog")) return;
      const b = e.target.closest("button");
      if (!b) return;
      if (b.dataset.hole) state.active = Number(b.dataset.hole);
      if (b.id === "openAcakHole") {
        window.open("/acak.html", "_blank", "noopener");
      }
      if (b.dataset.removePlayer) removePlayer(Number(b.dataset.removePlayer));
      if (b.id === "add") addPlayer();
      if (b.id === "startGame") {
        if (state.editingSetup) {
          if (LIVE_GAME_ID && LIVE_CAN_EDIT) {
            const ok = await pushLiveSetup();
            if (!ok) {
              await uiAlert(liveSaveStatus || "Live save gagal. Perubahan belum tersimpan ke server.", {
                title: "Gagal menyimpan",
                tone: "warn"
              });
              return;
            }
          } else {
            save();
          }
          state.editingSetup = false;
          state.showNineSummary = false;
          state.showFinalSummary = false;
          state.active = lastPlayableHole();
          recalcBankersFrom(0);
          flushSave();
          render();
          return;
        }
        const entered = state.players.map(p => p.trim()).filter(Boolean);
        if (entered.length < 2) {
          await uiAlert("Minimal isi 2 nama player.", { title: "Player belum lengkap" });
          return;
        }
        state.players = entered;
        state.started = true;
        if (!state.gameDate) state.gameDate = todayIso();
        state.active = 0;
        state.activeFrom = {};
        state.inactiveFrom = {};
        state.showNineSummary = false;
        state.showFinalSummary = false;
        state.holes = [];
      }
      if (b.id === "editSetup") {
        state.editingSetup = true;
        flushSave();
      }
      if (b.id === "newRound") {
        const ok = await uiConfirm("Mulai ronde baru dan hapus data ronde sekarang?", {
          title: "Ronde baru",
          okText: "Ya, hapus",
          cancelText: "Batal",
          tone: "warn"
        });
        if (!ok) return;
        localStorage.removeItem(KEY);
        localStorage.removeItem(`${KEY}-voor-backup`);
        sessionStorage.removeItem(`${KEY}-voor-backup`);
        state = defaultState();
        syncInputs();
      }
      if (b.id === "prev") state.active = Math.max(0, state.active - 1);
      if (b.id === "completeHole") completeCurrentHole();
      if (b.id === "viewTotal") openModal("Progress Total", progressHtml("total"));
      if (b.id === "viewBacarat") openModal("Progress Bacarat", progressHtml("bacarat"));
      if (b.id === "viewMatchplay") openModal("Matchplay & Voor Next Game", matchplayHtml());
      if (b.id === "viewScoreCard") openModal(state.holes.length && state.holes.every(h => h.completed) ? "Final Score Card" : "Current Score Card", currentScorecardHtml());
      if (b.id === "changeBanker") openModal("Ganti Bandar", changeBankerHtml());
      if (b.id === "changeHole") openModal("Ganti Hole", changeHoleHtml());
      if (b.id === "editRates") openModal("Ubah Rates", ratesFormHtml());
      if (b.id === "stopGolfer") openModal("Golfer Tidak Lanjut", stopGolferHtml());
      if (b.id === "confirmStopGolfer") {
        const selected = Number(document.getElementById("stopGolferSelect").value);
        const lastHole = Number(document.getElementById("stopLastHoleSelect").value);
        state.inactiveFrom[selected] = Math.min(lastHole + 1, roundHoles().length);
        if (state.holes[state.active]?.banker === selected) {
          const replacement = activeIndexes(state.active).find(idx => idx !== selected);
          if (replacement !== undefined) state.holes[state.active].banker = replacement;
        }
        document.getElementById("modal").classList.remove("show");
        render();
        return;
      }
      if (b.id === "confirmChangeBanker") {
        state.holes[state.active].banker = Number(document.getElementById("changeBankerSelect").value);
        state.holes[state.active].manualBanker = true;
        state.holes[state.active].needsManualBanker = false;
        state.holes[state.active].completed = false;
        document.getElementById("modal").classList.remove("show");
        render();
        return;
      }
      if (b.id === "resetAutoBanker") {
        if (manualBankerRequired(state.active)) {
          await uiAlert("Hole Par 3 wajib bandar manual, tidak bisa pakai auto.", {
            title: "Bandar manual",
            tone: "warn"
          });
          return;
        }
        state.holes[state.active].manualBanker = false;
        state.holes[state.active].needsManualBanker = false;
        state.holes[state.active].banker = autoBankerForHole(state.active);
        state.holes[state.active].completed = false;
        recalcBankersFrom(Math.max(0, state.active - 1));
        document.getElementById("modal").classList.remove("show");
        render();
        return;
      }
      if (b.id === "confirmChangeHole") {
        state.active = Number(document.getElementById("changeHoleSelect").value);
        state.showNineSummary = false;
        state.showFinalSummary = false;
        document.getElementById("modal").classList.remove("show");
        render();
        return;
      }
      if (b.id === "continueAfterNine") {
        state.showNineSummary = false;
        state.active = Math.min(9, roundHoles().length - 1);
      }
      if (b.id === "adjustBackNine") {
        state.editingSetup = true;
        state.showNineSummary = false;
        flushSave();
      }
      if (b.id === "finalMatchplay") openModal("Matchplay & Voor Next Game", matchplayHtml());
      if (b.id === "backToScoreCard") {
        state.showFinalSummary = false;
        state.active = Math.max(0, roundHoles().length - 1);
      }
      if (b.id === "saveRates") {
        document.getElementById("modal").classList.remove("show");
        render();
        return;
      }
      if (b.id === "viewLedger") openModal("Ledger", ledgerHtml());
      if (b.id === "closeModal") {
        document.getElementById("modal").classList.remove("show");
        return;
      }
      render();
    });
    document.getElementById("modal").addEventListener("click", e => {
      if (e.target.id === "modal") e.currentTarget.classList.remove("show");
    });
    window.addEventListener("pagehide", flushSave);
    window.addEventListener("resize", updateStickyOffset);
    document.addEventListener("visibilitychange", () => {
      if (document.visibilityState === "hidden") flushSave();
    });
    window.addEventListener("beforeunload", e => {
      if (!state.started || (LIVE_GAME_ID && !LIVE_CAN_EDIT)) return;
      if (LIVE_GAME_ID && LIVE_CAN_EDIT && !liveLoading) pushLiveState(true);
      else flushSave();
      e.preventDefault();
      e.returnValue = "";
    });

    load().then(() => {
      updateShareWhatsapp();
      render();
      if (LIVE_GAME_ID && !LIVE_CAN_EDIT) {
        setInterval(() => pullLiveState(true), 5000);
      }
    });
  </script>
</body>
</html>
