<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>You're In! – JambChance</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --green: #00C853;
      --dark: #0A0F0D;
      --card: #111810;
      --border: rgba(0,200,83,0.18);
      --text: #E8F5EC;
      --muted: #7A9A82;
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
      opacity: 0.13;
      pointer-events: none;
      z-index: 0;
    }
    .blob-1 { width: 500px; height: 500px; background: var(--green); top: -150px; right: -100px; }
    .blob-2 { width: 350px; height: 350px; background: #00e676; bottom: 80px; left: -80px; }

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

    /* MAIN CONTENT */
    .main {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 24px;
      position: relative;
      z-index: 5;
    }

    .card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 24px;
      padding: 52px 44px;
      max-width: 520px;
      width: 100%;
      text-align: center;
      position: relative;
      overflow: hidden;
      animation: fadeUp 0.5s ease both;
    }

    .card::before {
      content: '';
      position: absolute;
      top: 0; left: 50%;
      transform: translateX(-50%);
      width: 60%;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--green), transparent);
    }

    /* CHECKMARK ANIMATION */
    .check-wrap {
      width: 80px;
      height: 80px;
      margin: 0 auto 28px;
      position: relative;
    }

    .check-circle {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: rgba(0,200,83,0.1);
      border: 2px solid var(--green);
      display: flex;
      align-items: center;
      justify-content: center;
      animation: popIn 0.5s 0.2s cubic-bezier(0.34,1.56,0.64,1) both;
    }

    .check-circle svg {
      width: 36px;
      height: 36px;
      animation: drawCheck 0.4s 0.6s ease both;
    }

    .check-circle svg path {
      stroke: var(--green);
      stroke-width: 3;
      stroke-linecap: round;
      stroke-linejoin: round;
      fill: none;
      stroke-dasharray: 50;
      stroke-dashoffset: 50;
      animation: dash 0.4s 0.7s ease forwards;
    }

    @keyframes dash {
      to { stroke-dashoffset: 0; }
    }

    @keyframes popIn {
      from { opacity: 0; transform: scale(0.5); }
      to   { opacity: 1; transform: scale(1); }
    }

    /* CONFETTI DOTS */
    .confetti {
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 100px;
      overflow: hidden;
      pointer-events: none;
    }
    .dot {
      position: absolute;
      width: 6px; height: 6px;
      border-radius: 50%;
      opacity: 0;
      animation: fall 1.2s ease-out forwards;
    }
    .dot:nth-child(1)  { background: var(--green);  left: 15%; animation-delay: 0.5s; }
    .dot:nth-child(2)  { background: #fff;           left: 30%; animation-delay: 0.6s; }
    .dot:nth-child(3)  { background: var(--green);  left: 45%; animation-delay: 0.55s; }
    .dot:nth-child(4)  { background: #00e676;        left: 60%; animation-delay: 0.65s; }
    .dot:nth-child(5)  { background: #fff;           left: 75%; animation-delay: 0.5s; }
    .dot:nth-child(6)  { background: var(--green);  left: 85%; animation-delay: 0.7s; }
    .dot:nth-child(7)  { background: #00e676;        left: 22%; animation-delay: 0.8s; }
    .dot:nth-child(8)  { background: #fff;           left: 55%; animation-delay: 0.75s; }

    @keyframes fall {
      0%   { opacity: 0; transform: translateY(-10px) scale(0); }
      30%  { opacity: 1; }
      100% { opacity: 0; transform: translateY(80px) scale(1); }
    }

    .card h1 {
      font-family: 'Syne', sans-serif;
      font-size: 1.9rem;
      font-weight: 800;
      color: var(--white);
      letter-spacing: -0.8px;
      margin-bottom: 10px;
      animation: fadeUp 0.5s 0.3s ease both;
    }

    .card .subtitle {
      font-size: 1rem;
      color: var(--muted);
      line-height: 1.65;
      margin-bottom: 32px;
      animation: fadeUp 0.5s 0.4s ease both;
    }

    /* NAME HIGHLIGHT */
    .name-highlight {
      color: var(--green);
      font-weight: 600;
    }

    /* INFO PILLS */
    .info-row {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 32px;
      animation: fadeUp 0.5s 0.45s ease both;
    }

    .info-pill {
      display: flex;
      align-items: center;
      gap: 12px;
      background: rgba(0,200,83,0.06);
      border: 1px solid rgba(0,200,83,0.12);
      border-radius: 10px;
      padding: 12px 16px;
      text-align: left;
    }

    .pill-icon {
      width: 32px; height: 32px;
      background: rgba(0,200,83,0.12);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
      flex-shrink: 0;
    }

    .pill-text strong {
      display: block;
      font-size: 0.88rem;
      color: var(--white);
      font-weight: 500;
    }
    .pill-text span {
      font-size: 0.78rem;
      color: var(--muted);
    }

    /* SHARE SECTION */
    .share-section {
      animation: fadeUp 0.5s 0.5s ease both;
    }

    .share-label {
      font-size: 0.82rem;
      color: var(--muted);
      margin-bottom: 12px;
    }

    .share-btns {
      display: flex;
      gap: 10px;
      justify-content: center;
    }

    .btn-share {
      flex: 1;
      padding: 11px 16px;
      border-radius: 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.88rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s;
      border: 1px solid var(--border);
    }

    .btn-primary {
      background: var(--green);
      color: #0A0F0D;
      border-color: var(--green);
      font-weight: 600;
    }
    .btn-primary:hover { background: #00e676; }

    .btn-outline {
      background: transparent;
      color: var(--muted);
    }
    .btn-outline:hover { border-color: var(--green); color: var(--green); }

    .back-link {
      display: inline-block;
      margin-top: 24px;
      font-size: 0.82rem;
      color: rgba(122,154,130,0.5);
      text-decoration: none;
      transition: color 0.2s;
    }
    .back-link:hover { color: var(--green); }

    /* FOOTER */
    footer {
      position: relative;
      z-index: 5;
      text-align: center;
      padding: 20px;
      border-top: 1px solid var(--border);
      font-size: 0.76rem;
      color: rgba(122,154,130,0.35);
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 520px) {
      nav { padding: 18px 20px; }
      .card { padding: 36px 22px; }
      .share-btns { flex-direction: column; }
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
    <div class="card">

      <!-- Confetti -->
      <div class="confetti">
        <div class="dot"></div><div class="dot"></div>
        <div class="dot"></div><div class="dot"></div>
        <div class="dot"></div><div class="dot"></div>
        <div class="dot"></div><div class="dot"></div>
      </div>

      <!-- Check Icon -->
      <div class="check-wrap">
        <div class="check-circle">
          <svg viewBox="0 0 24 24">
            <path d="M5 12l5 5L19 7"/>
          </svg>
        </div>
      </div>

      <h1>You're on the list
        @if(isset($name)), <span class="name-highlight">{{ explode(' ', $name)[0] }}</span>@endif!
      </h1>

      <p class="subtitle">
        We've saved your spot. The moment JambChance launches,<br/>
        you'll be the first to know — straight to your inbox.
      </p>

      <!-- What Happens Next -->
      <div class="info-row">
        <div class="info-pill">
          <div class="pill-icon">📬</div>
          <div class="pill-text">
            <strong>Check your email</strong>
            <span>We sent a confirmation to
              @if(isset($email)) <strong style="color:var(--green)">{{ $email }}</strong>
              @else your inbox @endif
            </span>
          </div>
        </div>
        <div class="info-pill">
          <div class="pill-icon">🚀</div>
          <div class="pill-text">
            <strong>Launch coming soon</strong>
            <span>We're building JambChance based on your responses</span>
          </div>
        </div>
        <div class="info-pill">
          <div class="pill-icon">🎯</div>
          <div class="pill-text">
            <strong>Share & move up the list</strong>
            <span>Early sharers get priority beta access</span>
          </div>
        </div>
      </div>

      <!-- Share -->
      <div class="share-section">
        <p class="share-label">Know a friend writing JAMB? Share this with them 👇</p>
        <div class="share-btns">
          <button class="btn-share btn-primary" onclick="shareWhatsApp()">Share on WhatsApp</button>
          <button class="btn-share btn-outline" onclick="copyLink()">Copy Link</button>
        </div>
      </div>

      <a href="/" class="back-link">← Back to homepage</a>

    </div>
  </div>

  <footer>
    © 2025 JambChance · psalmedu.com · All rights reserved
  </footer>

  <script>
    const siteUrl = window.location.origin;
    const shareText = "Check your real JAMB admission chances before you apply! JambChance is launching soon 🎯";

    function shareWhatsApp() {
      const url = `https://wa.me/?text=${encodeURIComponent(shareText + ' ' + siteUrl)}`;
      window.open(url, '_blank');
    }

    function copyLink() {
      navigator.clipboard.writeText(siteUrl).then(() => {
        const btn = event.target;
        btn.textContent = 'Copied! ✓';
        btn.style.borderColor = 'var(--green)';
        btn.style.color = 'var(--green)';
        setTimeout(() => {
          btn.textContent = 'Copy Link';
          btn.style.borderColor = '';
          btn.style.color = '';
        }, 2500);
      });
    }
  </script>

</body>
</html>
