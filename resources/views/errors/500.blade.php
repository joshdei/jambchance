<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>500 – Something Went Wrong | JambChance</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --red: #FF4444;
      --red-dim: rgba(255,68,68,0.15);
      --dark: #0A0F0D;
      --card: #110D0D;
      --border: rgba(255,68,68,0.18);
      --text: #F5ECEC;
      --muted: #9A7A7A;
      --green: #00C853;
      --white: #ffffff;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--dark);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      overflow-x: hidden;
    }

    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 0;
      opacity: 0.4;
    }

    .blob {
      position: fixed;
      border-radius: 50%;
      filter: blur(130px);
      opacity: 0.1;
      pointer-events: none;
      z-index: 0;
    }
    .blob-1 { width: 500px; height: 500px; background: var(--red); top: -150px; right: -100px; }
    .blob-2 { width: 300px; height: 300px; background: #ff6b6b; bottom: 80px; left: -80px; }

    /* NAV */
    nav {
      position: relative;
      z-index: 10;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 24px 40px;
      border-bottom: 1px solid var(--border);
    }
    .logo {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.4rem;
      color: var(--white);
      letter-spacing: -0.5px;
      text-decoration: none;
    }
    .logo span { color: var(--green); }

    /* MAIN */
    .main {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 24px;
      position: relative;
      z-index: 5;
    }

    .content {
      max-width: 560px;
      width: 100%;
      text-align: center;
    }

    /* BIG 500 */
    .error-code {
      font-family: 'Syne', sans-serif;
      font-size: clamp(7rem, 20vw, 11rem);
      font-weight: 800;
      line-height: 1;
      letter-spacing: -6px;
      color: transparent;
      -webkit-text-stroke: 2px rgba(255,68,68,0.3);
      position: relative;
      margin-bottom: 8px;
      animation: fadeUp 0.5s ease both;
      user-select: none;
    }

    /* Glitch effect on 500 */
    .error-code::before,
    .error-code::after {
      content: '500';
      position: absolute;
      top: 0; left: 0; right: 0;
      font-family: 'Syne', sans-serif;
      font-size: inherit;
      font-weight: 800;
      letter-spacing: inherit;
      -webkit-text-stroke: 0;
    }
    .error-code::before {
      color: rgba(255,68,68,0.15);
      clip-path: polygon(0 30%, 100% 30%, 100% 50%, 0 50%);
      transform: translateX(-3px);
      animation: glitch1 3s infinite;
    }
    .error-code::after {
      color: rgba(255,150,150,0.1);
      clip-path: polygon(0 60%, 100% 60%, 100% 75%, 0 75%);
      transform: translateX(3px);
      animation: glitch2 3s infinite;
    }

    @keyframes glitch1 {
      0%, 90%, 100% { transform: translateX(-3px); opacity: 0.6; }
      92% { transform: translateX(3px); opacity: 1; }
      94% { transform: translateX(-3px); }
    }
    @keyframes glitch2 {
      0%, 88%, 100% { transform: translateX(3px); opacity: 0.4; }
      90% { transform: translateX(-4px); opacity: 0.8; }
      93% { transform: translateX(2px); }
    }

    /* ICON */
    .error-icon {
      width: 64px; height: 64px;
      background: var(--red-dim);
      border: 1px solid var(--border);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      margin: 0 auto 20px;
      animation: fadeUp 0.5s 0.1s ease both;
    }

    .content h1 {
      font-family: 'Syne', sans-serif;
      font-size: clamp(1.5rem, 4vw, 2rem);
      font-weight: 800;
      color: var(--white);
      letter-spacing: -0.6px;
      margin-bottom: 12px;
      animation: fadeUp 0.5s 0.15s ease both;
    }

    .content p {
      font-size: 1rem;
      color: var(--muted);
      line-height: 1.7;
      max-width: 420px;
      margin: 0 auto 36px;
      animation: fadeUp 0.5s 0.2s ease both;
    }

    /* ERROR CARD */
    .error-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 18px 20px;
      margin-bottom: 32px;
      text-align: left;
      position: relative;
      overflow: hidden;
      animation: fadeUp 0.5s 0.25s ease both;
    }

    .error-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0;
      width: 3px; height: 100%;
      background: var(--red);
      border-radius: 3px 0 0 3px;
    }

    .error-card-label {
      font-size: 0.72rem;
      font-weight: 600;
      color: var(--red);
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-bottom: 6px;
    }

    .error-card-msg {
      font-size: 0.88rem;
      color: rgba(255,255,255,0.35);
      font-family: 'Courier New', monospace;
    }

    /* BUTTONS */
    .btn-row {
      display: flex;
      gap: 12px;
      justify-content: center;
      animation: fadeUp 0.5s 0.3s ease both;
    }

    .btn {
      padding: 13px 24px;
      border-radius: 10px;
      font-family: 'Syne', sans-serif;
      font-size: 0.92rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s;
      text-decoration: none;
      border: none;
    }

    .btn-primary {
      background: var(--green);
      color: #0A0F0D;
    }
    .btn-primary:hover { background: #00e676; transform: translateY(-1px); }

    .btn-outline {
      background: transparent;
      color: var(--muted);
      border: 1px solid rgba(255,255,255,0.1);
    }
    .btn-outline:hover { border-color: rgba(255,255,255,0.3); color: var(--white); }

    /* STATUS DOTS */
    .status-row {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 20px;
      margin-top: 36px;
      animation: fadeUp 0.5s 0.35s ease both;
    }

    .status-item {
      display: flex;
      align-items: center;
      gap: 7px;
      font-size: 0.78rem;
      color: var(--muted);
    }

    .status-dot {
      width: 7px; height: 7px;
      border-radius: 50%;
    }
    .status-dot.ok { background: var(--green); box-shadow: 0 0 6px var(--green); }
    .status-dot.err { background: var(--red); box-shadow: 0 0 6px var(--red); animation: blink 1.2s infinite; }

    @keyframes blink {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.3; }
    }

    /* FOOTER */
    footer {
      position: relative;
      z-index: 5;
      text-align: center;
      padding: 20px;
      border-top: 1px solid var(--border);
      font-size: 0.76rem;
      color: rgba(154,122,122,0.35);
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 520px) {
      nav { padding: 18px 20px; }
      .btn-row { flex-direction: column; align-items: stretch; text-align: center; }
      .error-code { letter-spacing: -3px; }
    }
  </style>
</head>
<body>

  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>

  <nav>
    <a href="/" class="logo">Jamb<span>Chance</span></a>
  </nav>

  <div class="main">
    <div class="content">

      <div class="error-code">500</div>

      <div class="error-icon">⚡</div>

      <h1>Something broke on our end</h1>

      <p>
        Our server ran into an unexpected problem. This is not your fault — we've been notified and are working to fix it. Please try again in a moment.
      </p>

      <!-- Error Detail Card -->
      <div class="error-card">
        <div class="error-card-label">Server Error</div>
        <div class="error-card-msg">500 | Internal Server Error — Please try again shortly.</div>
      </div>

      <!-- Action Buttons -->
      <div class="btn-row">
        <a href="/" class="btn btn-primary">← Go Back Home</a>
        <button class="btn btn-outline" onclick="window.location.reload()">Try Again</button>
      </div>

      <!-- System Status -->
      <div class="status-row">
        <div class="status-item">
          <div class="status-dot ok"></div>
          Database Online
        </div>
        <div class="status-item">
          <div class="status-dot err"></div>
          Server Error
        </div>
        <div class="status-item">
          <div class="status-dot ok"></div>
          Network OK
        </div>
      </div>

    </div>
  </div>

  <footer>
    © 2025 JambChance · psalmedu.com · If this keeps happening, contact us.
  </footer>

</body>
</html>