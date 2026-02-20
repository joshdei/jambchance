
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>JambChance – Know Your Real Admission Chances</title>
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

    html { scroll-behavior: smooth; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--dark);
      color: var(--text);
      min-height: 100vh;
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
      filter: blur(120px);
      opacity: 0.12;
      pointer-events: none;
      z-index: 0;
    }
    .blob-1 { width: 500px; height: 500px; background: var(--green); top: -150px; right: -100px; }
    .blob-2 { width: 350px; height: 350px; background: #00e676; bottom: 100px; left: -80px; }

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
    }
    .logo span { color: var(--green); }

    .nav-badge {
      font-size: 0.78rem;
      font-weight: 500;
      background: rgba(0,200,83,0.12);
      color: var(--green);
      border: 1px solid var(--border);
      padding: 6px 14px;
      border-radius: 100px;
      letter-spacing: 0.3px;
    }

    .hero {
      position: relative;
      z-index: 5;
      max-width: 760px;
      margin: 0 auto;
      padding: 80px 24px 60px;
      text-align: center;
    }

    .hero-tag {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 0.82rem;
      font-weight: 500;
      color: var(--green);
      background: rgba(0,200,83,0.08);
      border: 1px solid var(--border);
      padding: 7px 16px;
      border-radius: 100px;
      margin-bottom: 28px;
      letter-spacing: 0.4px;
      animation: fadeUp 0.6s ease both;
    }
    .hero-tag::before {
      content: '';
      width: 7px; height: 7px;
      background: var(--green);
      border-radius: 50%;
      animation: pulse 1.8s infinite;
    }

    @keyframes pulse {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.4; transform: scale(0.7); }
    }

    h1 {
      font-family: 'Syne', sans-serif;
      font-size: clamp(2.4rem, 5vw, 3.8rem);
      font-weight: 800;
      line-height: 1.1;
      letter-spacing: -1.5px;
      color: var(--white);
      margin-bottom: 20px;
      animation: fadeUp 0.6s 0.1s ease both;
    }
    h1 em {
      font-style: normal;
      color: var(--green);
    }

    .hero-sub {
      font-size: 1.08rem;
      font-weight: 300;
      color: var(--muted);
      line-height: 1.7;
      max-width: 540px;
      margin: 0 auto 40px;
      animation: fadeUp 0.6s 0.2s ease both;
    }

    .pain-row {
      display: flex;
      gap: 10px;
      justify-content: center;
      flex-wrap: wrap;
      margin-bottom: 50px;
      animation: fadeUp 0.6s 0.3s ease both;
    }
    .pain-chip {
      font-size: 0.82rem;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.08);
      padding: 7px 14px;
      border-radius: 100px;
      color: var(--muted);
    }
    .pain-chip s { color: rgba(255,100,100,0.8); }

    .stats-strip {
      position: relative;
      z-index: 5;
      display: flex;
      justify-content: center;
      max-width: 540px;
      margin: 0 auto 50px;
      padding: 0 24px;
    }
    .stat {
      flex: 1;
      text-align: center;
      padding: 20px 10px;
      border: 1px solid var(--border);
      background: rgba(0,200,83,0.03);
    }
    .stat:first-child { border-radius: 12px 0 0 12px; }
    .stat:last-child { border-radius: 0 12px 12px 0; }
    .stat + .stat { border-left: none; }
    .stat-num {
      font-family: 'Syne', sans-serif;
      font-size: 1.5rem;
      font-weight: 800;
      color: var(--green);
    }
    .stat-label { font-size: 0.75rem; color: var(--muted); margin-top: 2px; }

    .form-section {
      position: relative;
      z-index: 5;
      max-width: 540px;
      margin: 0 auto;
      padding: 0 24px 80px;
      animation: fadeUp 0.6s 0.35s ease both;
    }

    .form-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 20px;
      padding: 36px 32px;
      position: relative;
      overflow: hidden;
    }

    .form-card::before {
      content: '';
      position: absolute;
      top: 0; left: 50%;
      transform: translateX(-50%);
      width: 60%;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--green), transparent);
    }

    .form-title {
      font-family: 'Syne', sans-serif;
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--white);
      margin-bottom: 6px;
    }
    .form-subtitle { font-size: 0.88rem; color: var(--muted); margin-bottom: 28px; }

    .field-group {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
      margin-bottom: 14px;
    }
    .field-group.full { grid-template-columns: 1fr; }

    label {
      display: block;
      font-size: 0.8rem;
      font-weight: 500;
      color: var(--muted);
      margin-bottom: 7px;
      letter-spacing: 0.3px;
    }
    label span.req { color: var(--green); }
    label span.opt { font-size: 0.7rem; color: rgba(122,154,130,0.5); font-weight: 400; }

    input, select {
      width: 100%;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 10px;
      padding: 12px 14px;
      font-size: 0.92rem;
      font-family: 'DM Sans', sans-serif;
      color: var(--white);
      outline: none;
      transition: border-color 0.2s, background 0.2s;
      -webkit-appearance: none;
    }
    input::placeholder { color: rgba(255,255,255,0.2); }
    input:focus, select:focus {
      border-color: var(--green);
      background: rgba(0,200,83,0.05);
    }
    select option { background: #1a2e1f; color: var(--white); }

    .divider {
      display: flex;
      align-items: center;
      gap: 12px;
      margin: 20px 0;
      color: rgba(255,255,255,0.25);
      font-size: 0.78rem;
    }
    .divider::before, .divider::after {
      content: ''; flex: 1;
      height: 1px;
      background: rgba(255,255,255,0.08);
    }

    .submit-btn {
      width: 100%;
      padding: 15px;
      background: var(--green);
      color: #0A0F0D;
      border: none;
      border-radius: 12px;
      font-family: 'Syne', sans-serif;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s;
      margin-top: 8px;
    }
    .submit-btn:hover { background: #00e676; transform: translateY(-1px); }
    .submit-btn:active { transform: translateY(0); }

    .privacy-note {
      text-align: center;
      font-size: 0.76rem;
      color: rgba(122,154,130,0.5);
      margin-top: 14px;
    }

    .success-state {
      display: none;
      text-align: center;
      padding: 20px 0;
    }
    .success-icon {
      width: 60px; height: 60px;
      background: rgba(0,200,83,0.12);
      border: 2px solid var(--green);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 16px;
      font-size: 1.6rem;
    }
    .success-state h3 {
      font-family: 'Syne', sans-serif;
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--white);
      margin-bottom: 8px;
    }
    .success-state p { font-size: 0.9rem; color: var(--muted); }
    .share-btn {
      background: transparent;
      border: 1px solid var(--green);
      color: var(--green);
      padding: 10px 24px;
      border-radius: 8px;
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      margin-top: 16px;
    }
    .share-btn:hover { background: rgba(0,200,83,0.1); }

    .social-proof {
      position: relative;
      z-index: 5;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 16px;
      padding: 0 24px 20px;
      flex-wrap: wrap;
    }
    .proof-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.82rem;
      color: var(--muted);
    }
    .proof-dot { width: 5px; height: 5px; background: var(--green); border-radius: 50%; }

    footer {
      position: relative;
      z-index: 5;
      text-align: center;
      padding: 24px;
      border-top: 1px solid var(--border);
      font-size: 0.78rem;
      color: rgba(122,154,130,0.4);
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 520px) {
      nav { padding: 18px 20px; }
      .hero { padding: 50px 20px 40px; }
      .field-group { grid-template-columns: 1fr; }
      .form-card { padding: 28px 20px; }
    }
  </style>
</head>
<body>

  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>

  <nav>
    <div class="logo">Jamb<span>Chance</span></div>
    <div class="nav-badge">Early Access Open</div>
  </nav>

  <section class="hero">
    <div class="hero-tag">Free Admission Intelligence for Nigerian Students</div>
    <h1>Know Your <em>Real</em><br/>Admission Chances</h1>
    <p class="hero-sub">
      Stop applying blindly. JambChance analyzes your JAMB score, course, state of origin, and finances to show you exactly where you stand — before you waste an attempt.
    </p>
    <div class="pain-row">
      <div class="pain-chip"><s>Score 240, still no Medicine</s></div>
      <div class="pain-chip"><s>Forced into unwanted course</s></div>
      <div class="pain-chip"><s>Hidden fees after admission</s></div>
      <div class="pain-chip"><s>Wasted JAMB attempts</s></div>
    </div>
  </section>

  <div class="stats-strip">
    <div class="stat">
      <div class="stat-num">36+</div>
      <div class="stat-label">States Covered</div>
    </div>
    <div class="stat">
      <div class="stat-num">200+</div>
      <div class="stat-label">Universities</div>
    </div>
    <div class="stat">
      <div class="stat-num">100%</div>
      <div class="stat-label">Free to Use</div>
    </div>
  </div>

<section class="form-section">
    <div class="form-card">

      <!-- Add CSRF token meta tag if not already in head -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <div id="formContent">
        <div class="form-title">Join the Waitlist</div>
        <div class="form-subtitle">Be first to know when JambChance launches. Takes 30 seconds.</div>

        <form id="waitlistForm" onsubmit="handleSubmit(event)" novalidate>

          <div class="field-group">
            <div>
              <label for="fname">Full Name <span class="req">*</span></label>
              <input type="text" id="fname" placeholder="e.g. Chukwuemeka Obi" required />
            </div>
            <div>
              <label for="email">Email Address <span class="req">*</span></label>
              <input type="email" id="email" placeholder="you@example.com" required />
            </div>
          </div>

          <div class="divider">Optional — helps us build better for you</div>

          <div class="field-group">
            <div>
              <label for="score">JAMB Score Range <span class="opt">(optional)</span></label>
              <select id="score">
                <option value="">Select range</option>
                <option value="Below 180">Below 180</option>
                <option value="180 – 199">180 – 199</option>
                <option value="200 – 219">200 – 219</option>
                <option value="220 – 249">220 – 249</option>
                <option value="250 and above">250 and above</option>
              </select>
            </div>
            <div>
     
    <div>
        <label for="state">State of Origin <span class="opt">(optional)</span></label>
        <select id="state">
            <option value="">Select state</option>
            <option value="Abia">Abia</option>
            <option value="Adamawa">Adamawa</option>
            <option value="Akwa Ibom">Akwa Ibom</option>
            <option value="Anambra">Anambra</option>
            <option value="Bauchi">Bauchi</option>
            <option value="Bayelsa">Bayelsa</option>
            <option value="Benue">Benue</option>
            <option value="Borno">Borno</option>
            <option value="Cross River">Cross River</option>
            <option value="Delta">Delta</option>
            <option value="Ebonyi">Ebonyi</option>
            <option value="Edo">Edo</option>
            <option value="Ekiti">Ekiti</option>
            <option value="Enugu">Enugu</option>
            <option value="Gombe">Gombe</option>
            <option value="Imo">Imo</option>
            <option value="Jigawa">Jigawa</option>
            <option value="Kaduna">Kaduna</option>
            <option value="Kano">Kano</option>
            <option value="Katsina">Katsina</option>
            <option value="Kebbi">Kebbi</option>
            <option value="Kogi">Kogi</option>
            <option value="Kwara">Kwara</option>
            <option value="Lagos">Lagos</option>
            <option value="Nasarawa">Nasarawa</option>
            <option value="Niger">Niger</option>
            <option value="Ogun">Ogun</option>
            <option value="Ondo">Ondo</option>
            <option value="Osun">Osun</option>
            <option value="Oyo">Oyo</option>
            <option value="Plateau">Plateau</option>
            <option value="Rivers">Rivers</option>
            <option value="Sokoto">Sokoto</option>
            <option value="Taraba">Taraba</option>
            <option value="Yobe">Yobe</option>
            <option value="Zamfara">Zamfara</option>
            <option value="FCT">FCT – Abuja</option>
        </select>
    </div>
</div>
            </div>
          </div>

          <div class="field-group full">
            <div>
              <label for="course">Preferred Course <span class="opt">(optional)</span></label>
              <select id="course">
                <option value="">Select course</option>
                <option value="Medicine & Surgery">Medicine & Surgery</option>
                <option value="Law">Law</option>
                <option value="Engineering">Engineering</option>
                <option value="Nursing">Nursing</option>
                <option value="Pharmacy">Pharmacy</option>
                <option value="Accounting">Accounting</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Economics">Economics</option>
                <option value="Mass Communication">Mass Communication</option>
                <option value="Architecture">Architecture</option>
                <option value="Medical Laboratory Science">Medical Laboratory Science</option>
                <option value="Biochemistry">Biochemistry</option>
                <option value="Microbiology">Microbiology</option>
                <option value="Education">Education</option>
                <option value="Business Administration">Business Administration</option>
                <option value="Other">Other</option>
              </select>
            </div>
          </div>

          <!-- Loading indicator -->
          <div id="loadingIndicator" style="display: none; text-align: center; margin: 15px 0;">
            <div class="spinner"></div>
            <p style="color: #666; font-size: 14px;">Processing...</p>
          </div>

          <!-- Error message container -->
          <div id="errorContainer" style="display: none; background: #fee; color: #c00; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 14px; text-align: center;"></div>

          <button type="submit" class="submit-btn" id="submitBtn">Get Early Access →</button>
        </form>

        <p class="privacy-note">🔒 No spam. No sharing. We only use this to build JambChance for you.</p>
      </div>

      <div class="success-state" id="successState" style="display: none;">
        <div class="success-icon">✓</div>
        <h3>You're on the list!</h3>
        <p>We'll notify you the moment JambChance launches.<br/>Share with a friend who also needs this.</p>
        <button class="share-btn" onclick="shareLink()">Share JambChance 🔗</button>
      </div>

    </div>
  </section>

  <!-- Add spinner styles -->
  <style>
    .spinner {
      border: 3px solid #f3f3f3;
      border-top: 3px solid #667eea;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      animation: spin 1s linear infinite;
      margin: 0 auto;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    .submit-btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }
  </style>

  <script>
    async function handleSubmit(e) {
      e.preventDefault();
      
      // Get form values
      const name = document.getElementById('fname').value.trim();
      const email = document.getElementById('email').value.trim();
      const score = document.getElementById('score').value;
      const state = document.getElementById('state').value;
      const course = document.getElementById('course').value;
      
      // Validate required fields
      if (!name) { 
        showError('Please enter your full name.'); 
        return; 
      }
      
      if (!email || !email.includes('@') || !email.includes('.')) { 
        showError('Please enter a valid email address.'); 
        return; 
      }
      
      // Show loading state
      const submitBtn = document.getElementById('submitBtn');
      const loadingIndicator = document.getElementById('loadingIndicator');
      const errorContainer = document.getElementById('errorContainer');
      
      submitBtn.disabled = true;
      loadingIndicator.style.display = 'block';
      errorContainer.style.display = 'none';
      
      try {
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        
        if (!csrfToken) {
          throw new Error('CSRF token not found. Please refresh the page.');
        }
        
        // Prepare data for submission
        const formData = {
          full_name: name,
          email: email,
          jamb_score_range: score || null,
          state_of_origin: state || null,
          preferred_course: course || null,
          other_course: course === 'Other' ? prompt('Please specify your course:') : null
        };
        
        // Send data to Laravel backend
        const response = await fetch('/waitlist/submit', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify(formData)
        });
        
        const data = await response.json();
        
        if (response.ok && data.success) {
          // Success - show success state
          console.log('Successfully joined waitlist:', data);
          
          // Hide form, show success
          document.getElementById('formContent').style.display = 'none';
          document.getElementById('successState').style.display = 'block';
          
          // Optional: Send to Google Analytics or tracking
          if (typeof gtag !== 'undefined') {
            gtag('event', 'waitlist_signup', {
              'event_category': 'engagement',
              'event_label': course || 'unknown'
            });
          }
          
        } else {
          // Handle validation errors
          if (data.errors) {
            const errorMessages = Object.values(data.errors).flat().join(', ');
            showError(errorMessages || 'Validation failed. Please check your inputs.');
          } else {
            showError(data.message || 'Something went wrong. Please try again.');
          }
        }
      } catch (error) {
        console.error('Submission error:', error);
        showError('Network error. Please check your connection and try again.');
      } finally {
        // Hide loading state
        submitBtn.disabled = false;
        loadingIndicator.style.display = 'none';
      }
    }
    
    function showError(message) {
      const errorContainer = document.getElementById('errorContainer');
      errorContainer.textContent = message;
      errorContainer.style.display = 'block';
      
      // Auto-hide after 5 seconds
      setTimeout(() => {
        errorContainer.style.display = 'none';
      }, 5000);
    }
    
    function shareLink() {
      const text = 'Check your real JAMB admission chances before you apply! JambChance is launching soon 🎯';
      if (navigator.share) {
        navigator.share({ 
          title: 'JambChance', 
          text: text, 
          url: window.location.href 
        });
      } else {
        navigator.clipboard.writeText(window.location.href)
          .then(() => alert('Link copied! Share it with your friends.'))
          .catch(() => alert('Could not copy link. Please copy manually.'));
      }
    }
    
    // Optional: Add real-time email validation
    document.getElementById('email').addEventListener('blur', async function() {
      const email = this.value.trim();
      if (email && email.includes('@') && email.includes('.')) {
        try {
          const response = await fetch(`/waitlist/check-email?email=${encodeURIComponent(email)}`);
          const data = await response.json();
          
          if (data.exists) {
            showError('This email is already on our waitlist. Thank you!');
          }
        } catch (error) {
          // Silently fail - don't bother user
        }
      }
    });
    
    // Optional: Add loading state to button text
    const originalButtonText = document.querySelector('.submit-btn').textContent;
  </script>

  <div class="social-proof">
    <div class="proof-item"><div class="proof-dot"></div> Built for Nigerian Students</div>
    <div class="proof-item"><div class="proof-dot"></div> Free Forever</div>
    <div class="proof-item"><div class="proof-dot"></div> Launching 2025</div>
  </div>

  <footer>
    © 2025 JambChance · psalmedu.com · All rights reserved
  </footer>


</body>
</html>
