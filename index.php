<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Blood Bridge — Smart Blood Donor & Request System</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

</head>
<body>

  <header class="navbar">
    <div class="container nav-inner">

      <div class="brand">
        <img src="Images/Blood-logo.jpeg" class="logo-img" />
        <span class="brand-text">Blood Bridge</span>
      </div>

      <nav class="menu">
        <a href="#">Home</a>
        <a href="donor_dashboard.php">Donors</a>
        <a href="requester_dashboard.php">Request</a>
        <a href="about.html">About</a>
        <a href="contact.php">Contact</a>
      </nav>

      <div class="auth">
        <a href="login.php" class="btn-outline" target="_blank">Login</a>
        <a href="register.php" class="btn-primary small" target="_blank">Register</a>
      </div>

    </div>
  </header>

  <section class="hero">

    <div class="container hero-inner">

      <div class="hero-left">
        <h1>
          Blood Bridge — <span>Smart Blood Donor & Request System</span>
        </h1>

        <p class="lead">
          Connecting verified blood donors with patients in urgent need fast, simple, and secure. 
          Saving lives one match at a time, through a smarter and more reliable blood donation network.
        </p>

        <div class="cta-row">
          <a href="requester_dashboard.php" class="btn-cta">Request Blood</a>
          <a href="register.php" class="btn-cta alt">Become a Donor</a>
        </div>
      </div>

      <div class="hero-right">
        <div class="blob">
          <img src="images/blood-donate.png" class="main-img" alt="">
        </div>
    </div>
  </div>

    <div class="hero-wave">
      <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
        <path d="M0 40 C 300 120 900 0 1440 60 L1440 120 L0 120 Z" fill="#ffffff"/> 
      </svg>
    </div>
  </section>

  <section class="why-section">
  <div class="container">

    <h2 class="why-title">Why Donate Blood?</h2>
    <p class="why-subtitle">Your one donation can save up to 3 lives — every drop matters.</p>

    <div class="why-grid">

      <!-- CARD 1 -->
      <div class="why-card card1">
        <div class="circle-wrap">
          <div class="circle-inner">
            <i class="fas fa-hand-holding-heart"></i>
          </div>
          <div class="circle-btn"><i class="fas fa-play"></i></div>
        </div>
        <h3>Saves Lives</h3>
        <p>Your single blood donation can save accident victims, surgery patients, and those battling cancer.</p>
      </div>

      <!-- CARD 2 -->
      <div class="why-card card2">
        <div class="circle-wrap">
          <div class="circle-inner">
            <i class="fas fa-heartbeat"></i>
          </div>
          <div class="circle-btn"><i class="fas fa-play"></i></div>
        </div>
        <h3>Health Benefits</h3>
        <p>Donating improves blood flow, reduces stress, and gives you a free mini health check.</p>
      </div>

      <!-- CARD 3 -->
      <div class="why-card card3">
        <div class="circle-wrap">
          <div class="circle-inner">
            <i class="fas fa-clock"></i>
          </div>
          <div class="circle-btn"><i class="fas fa-play"></i></div>
        </div>
        <h3>Constant Demand</h3>
        <p>Every 2 seconds someone needs blood — it cannot be manufactured and expires quickly.</p>
      </div>

      <!-- CARD 4 -->
      <div class="why-card card4">
        <div class="circle-wrap">
          <div class="circle-inner">
            <i class="fas fa-users"></i>
          </div>
          <div class="circle-btn"><i class="fas fa-play"></i></div>
        </div>
        <h3>Community Support</h3>
        <p>Your donation strengthens your community by helping hospitals during shortages.</p>
      </div>

    </div>
  </div>
</section>

<section class="how-it-works-section">

    <h2 class="how-title">How It Works</h2>

    <div class="how-wrapper">

        <!-- Step 1 -->
        <div class="how-step">
            <div class="how-circle">
                <span class="how-number">1</span>

                <div class="how-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
            <h3>Register as Donor</h3>
            <p>Create your donor profile and medical details.</p>
        </div>

        <div class="dotted-line"></div>

        <!-- Step 2 -->
        <div class="how-step">
            <div class="how-circle">
                <span class="how-number">2</span>

                <div class="how-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <h3>Search Donors</h3>
            <p>Find donors available near your location.</p>
        </div>

        <div class="dotted-line"></div>

        <!-- Step 3 -->
        <div class="how-step">
            <div class="how-circle">
                <span class="how-number">3</span>

                <div class="how-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
            </div>
            <h3>Request Blood</h3>
            <p>Send urgent blood requests instantly.</p>
        </div>

        <div class="dotted-line"></div>

        <!-- Step 4 -->
        <div class="how-step">
            <div class="how-circle">
                <span class="how-number">4</span>

                <div class="how-icon">
                    <i class="fas fa-hospital"></i>
                </div>
            </div>
            <h3>Hospital Verification</h3>
            <p>Hospital confirms availability and need.</p>
        </div>

        <div class="dotted-line"></div>

        <!-- Step 5 -->
        <div class="how-step">
            <div class="how-circle">
                <span class="how-number">5</span>

                <div class="how-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <h3>Successful Donation</h3>
            <p>Donor visits hospital and completes donation.</p>
        </div>

    </div>
</section>

<section class="blood-categories">
    <h2>Blood Categories / Blood Groups</h2>
    <div class="categories-container">

    <!-- RIGHT SIDE IMAGE -->
        <div class="categories-left">
            <img src="Images/blood-bag.png" alt="Blood Groups Image">
        </div>

        <!-- LEFT SIDE CONTENT -->
        <div class="categories-right">

            <div class="category-title">
                <i class="fas fa-tint"></i>
                <h3>Available Blood Groups</h3>
            </div>

            <div class="blood-group-cards">

                <div class="group-card">A+</div>
                <div class="group-card">A-</div>
                <div class="group-card">B+</div>
                <div class="group-card">B-</div>
                <div class="group-card">AB+</div>
                <div class="group-card">AB-</div>
                <div class="group-card">O+</div>
                <div class="group-card">O-</div>

            </div>
        </div>
    </div>
</section>

<section class="eligibility-section">
    <div class="eligibility-container">

        <!-- LEFT SIDE IMAGE -->
        <div class="eligibility-image">
            <img src="Images/blood-donor.jpg">
        </div>

        <!-- RIGHT SIDE CONTENT -->
        <div class="eligibility-content">
            <h2 class="eligibility-title">Who Can Donate Blood?</h2>
            <p class="eligibility-subtitle">Check if you meet the basic requirements to become a donor.</p>

            <div class="eligibility-list">

                <div class="eligibility-item">
                    <div class="eligibility-icon"><i class="fas fa-user"></i></div>
                    <p>Age must be between <strong>18 to 60 years</strong>.</p>
                </div>

                <div class="eligibility-item">
                    <div class="eligibility-icon"><i class="fas fa-weight"></i></div>
                    <p>Minimum weight should be <strong>50kg</strong>.</p>
                </div>

                <div class="eligibility-item">
                    <div class="eligibility-icon"><i class="fas fa-heartbeat"></i></div>
                    <p>Donor must be in <strong>good health</strong>.</p>
                </div>

                <div class="eligibility-item">
                    <div class="eligibility-icon"><i class="fas fa-syringe"></i></div>
                    <p>No major surgery in the <strong>last 6 months</strong>.</p>
                </div>

                <div class="eligibility-item">
                    <div class="eligibility-icon"><i class="fas fa-tint"></i></div>
                    <p>Hemoglobin levels should be <strong>normal</strong>.</p>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="donor-section">
  <div class="donor-container">

    <!-- LEFT CONTENT -->
    <div class="donor-content">
      <h2>Become a Donor Today</h2>
      <p>Your small contribution can save lives. Join thousands of registered donors who make a real impact every day.</p>

      <div class="donor-buttons">
        <a href="register.php" class="btn-primary">Register as Donor</a>
        <a href="about.html" class="btn-secondary">Learn More</a>
      </div>

      <div class="donor-stats">
        <div class="stat-box">
          <h3>25k+</h3>
          <p>Active Donors</p>
        </div>
        <div class="stat-box">
          <h3>3 Lives</h3>
          <p>Saved Per Donation</p>
        </div>
        <div class="stat-box">
          <h3>1 Min</h3>
          <p>Quick Signup</p>
        </div>
      </div>
    </div>

    <!-- RIGHT IMAGE -->
    <div class="donor-image">
      <div class="donor-img-bg"></div>
      <img src="Images/donation-pic.png" alt="Blood Donor">
    </div>

  </div>
</section>

<section class="donation-section">
    <h2>Available Donors</h2>
    <p class="subtitle">Find verified donors near you in just a few seconds.</p>

    <!-- FILTER BAR -->
    <div class="filter-bar">
        <select>
            <option>Blood Group</option>
            <option>A+</option>
            <option>A-</option>
            <option>B+</option>
            <option>B-</option>
            <option>O+</option>
            <option>O-</option>
            <option>AB+</option>
            <option>AB-</option>
        </select>

        <select>
            <option>City</option>
            <option>Karachi</option>
            <option>Hyderabad</option>
            <option>Sukkur</option>
            <option>Nawabshah</option>
        </select>

        <select>
            <option>Area</option>
            <option>City Center</option>
            <option>Qasimabad</option>
            <option>Latifabad</option>
        </select>

        <button class="search-btn">Search</button>
    </div>

    <!-- DONOR CARDS -->
    <div class="donor-grid">

        <!-- CARD 1 -->
        <div class="donor-card">
            <div class="icon-area">
                <i class="fa-solid fa-user"></i>
            </div>
            <h3>Ali Ahmed</h3>
            <span class="blood-badge">A+</span>
            <p class="location">Karachi - North Nazimabad</p>
            <p class="donated">Last Donated: 20 days ago</p>
            <span class="status available">Available</span>
            <button class="request-btn">Request</button>
        </div>

        <!-- CARD 2 -->
        <div class="donor-card">
            <div class="icon-area">
                <i class="fa-solid fa-user"></i>
            </div>
            <h3>Sara Khan</h3>
            <span class="blood-badge">O+</span>
            <p class="location">Hyderabad - Qasimabad</p>
            <p class="donated">Last Donated: 45 days ago</p>
            <span class="status not-available">Not Available</span>
            <button class="request-btn">Request</button>
        </div>

        <!-- CARD 3 -->
        <div class="donor-card">
            <div class="icon-area">
                <i class="fa-solid fa-user"></i>
            </div>
            <h3>Usman Shah</h3>
            <span class="blood-badge">B-</span>
            <p class="location">Sukkur - City Area</p>
            <p class="donated">Last Donated: 10 days ago</p>
            <span class="status available">Available</span>
            <button class="request-btn">Request</button>
        </div>
    </div>

    <div class="load-more">
        <button>Load More Donors</button>
    </div>
</section>

<section class="donation-camps">
    <div class="camp-container">

        <h2 class="camp-title">Upcoming Donation Camps</h2>
        <p class="camp-subtitle">Join life-saving donation events happening near you.</p>

        <div class="camp-wrapper">

            <!-- Camp 1 -->
            <div class="camp-card">
                <div class="camp-date">
                    <h3>12</h3>
                    <span>JAN</span>
                </div>

                <div class="camp-info">
                    <img src="Images/donation-camp.png" alt="camp icon" class="camp-illustration">

                    <h3>City Hospital Blood Camp</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Main City Hospital, Karachi</p>
                    <p><i class="fas fa-clock"></i> 09:00 AM – 4:00 PM</p>
                    <button class="camp-btn">Register Now</button>
                </div>
            </div>

            <!-- Camp 2 -->
            <div class="camp-card">
                <div class="camp-date">
                    <h3>21</h3>
                    <span>JAN</span>
                </div>

                <div class="camp-info">
                    <img src="Images/donation-drive.png" alt="camp icon" class="camp-illustration">

                    <h3>Red Cross Donation Drive</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Civic Center Hall, Hyderabad</p>
                    <p><i class="fas fa-clock"></i> 10:00 AM - 3:30 PM</p>
                    <button class="camp-btn">Register Now</button>
                </div>
            </div>

            <!-- Camp 3 -->
            <div class="camp-card">
                <div class="camp-date">
                    <h3>05</h3>
                    <span>FEB</span>
                </div>

                <div class="camp-info">
                    <img src="Images/community-camp.png" alt="camp icon" class="camp-illustration">

                    <h3>Community Blood Awareness Camp</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Public Park, Nawabshah</p>
                    <p><i class="fas fa-clock"></i> 08:30 AM - 2:00 PM</p>
                    <button class="camp-btn">Register Now</button>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= FAQ SECTION ================= -->
<section class="faq-section" id="faq">
    <div class="faq-container">

        <!-- Left Side (FAQ List) -->
        <div class="faq-left">
            <h2 class="faq-title">Frequently Asked Questions</h2>

            <!-- FAQ Item 1 -->
            <div class="faq-item">
                <input type="checkbox" id="faq1">
                <label for="faq1" class="faq-question">
                    <span>Who can donate blood?</span>
                    <i class="fa-solid fa-plus"></i>
                </label>
                <div class="faq-answer">
                    Anyone aged 18–60, in good health, and weighing above 50kg is eligible to donate.
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="faq-item">
                <input type="checkbox" id="faq2">
                <label for="faq2" class="faq-question">
                    <span>How often can I donate blood?</span>
                    <i class="fa-solid fa-plus"></i>
                </label>
                <div class="faq-answer">
                    You can donate blood every 3 months if you meet the basic health requirements.
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="faq-item">
                <input type="checkbox" id="faq3">
                <label for="faq3" class="faq-question">
                    <span>Is blood donation safe?</span>
                    <i class="fa-solid fa-plus"></i>
                </label>
                <div class="faq-answer">
                    Yes! Sterile, disposable equipment is used every time you donate, ensuring safety.
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="faq-item">
                <input type="checkbox" id="faq4">
                <label for="faq4" class="faq-question">
                    <span>How long does the donation process take?</span>
                    <i class="fa-solid fa-plus"></i>
                </label>
                <div class="faq-answer">
                    The complete process takes around 20–25 minutes including registration and rest time.
                </div>
            </div>

            <!-- FAQ Item 5 -->
            <div class="faq-item">
                <input type="checkbox" id="faq5">
                <label for="faq5" class="faq-question">
                    <span>What should I do before donating blood?</span>
                    <i class="fa-solid fa-plus"></i>
                </label>
                <div class="faq-answer">
                    Eat a healthy meal, drink plenty of water, and avoid heavy exercise before donating.
                </div>
            </div>

        </div>

        <!-- Right Side Contact Box -->
        <div class="faq-right">
            <div class="faq-help-box">
                <i class="fa-solid fa-message faq-help-icon"></i>
                <h3>Do you have more questions?</h3>
                <p>If you have additional questions, feel free to contact us anytime. We are always happy to help!</p>
                <a href="#" class="faq-btn">Contact Support</a>
            </div>
        </div>

    </div>
</section>

<!-- ================= FOOTER SECTION ================= -->
<footer class="main-footer">

    <div class="footer-container">

        <!-- Column 1 -->
        <div class="footer-col">
            <h2 class="footer-logo">BloodBridge</h2>
            <p>Your small effort can save someone's life. Join us in building a healthier, safer community.</p>
        </div>

        <!-- Column 2 -->
        <div class="footer-col">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="#hero">Home</a></li>
                <li><a href="#why">Why Donate?</a></li>
                <li><a href="#how">How It Works</a></li>
                <li><a href="#categories">Blood Groups</a></li>
                <li><a href="#donate">Become a Donor</a></li>
            </ul>
        </div>

        <!-- Column 3 -->
        <div class="footer-col">
            <h4>Important</h4>
            <ul>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#find">Find Donors</a></li>
                <li><a href="#camps">Upcoming Camps</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
            </ul>
        </div>

        <!-- Column 4 -->
        <div class="footer-col">
            <h4>Contact</h4>
            <p><i class="fa-solid fa-phone"></i> +92 3028416312</p>
            <p><i class="fa-solid fa-envelope"></i> bloodbridge@gmail.com</p>

            <div class="footer-social">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>

    </div>

    <!-- Bottom Bar -->
    <div class="footer-bottom">
        <p>© 2026 BloodBridge. All Rights Reserved.</p>
    </div>

</footer>


<!-- ===== BLOOD BRIDGE CHATBOT WIDGET ===== -->
<div id="bb-chat-bubble" onclick="toggleChat()">
  <i class="fas fa-comment-dots"></i>
</div>

<div id="bb-chat-window">
  <div id="bb-chat-header">
    <div class="bb-header-left">
      <div class="bb-avatar"><i class="fas fa-heartbeat"></i></div>
      <div>
        <strong>Blood Bridge Assistant</strong>
        <span class="bb-online">&#9679; Online</span>
      </div>
    </div>
    <button onclick="toggleChat()" class="bb-close-btn"><i class="fas fa-times"></i></button>
  </div>

  <div id="bb-chat-messages">
    <div class="bb-msg bot">
      <i class="fas fa-hand-sparkles" style="color:#BF1A1A"></i> Assalamu Alaikum! I am Blood Bridge Assistant.<br>
      You can ask in Urdu or English.<br><br>
      <i class="fas fa-comment-dots" style="color:#BF1A1A"></i> <em>How can I help you today?</em>
    </div>
  </div>

  <div id="bb-quick-btns">
    <button onclick="quickAsk('Blood donate kaise karun?')"><i class="fas fa-tint"></i> Donate</button>
    <button onclick="quickAsk('How to register?')"><i class="fas fa-user-plus"></i> Register</button>
    <button onclick="quickAsk('Emergency blood chahiye')"><i class="fas fa-ambulance"></i> Emergency</button>
    <button onclick="quickAsk('Blood groups kaun se hain?')"><i class="fas fa-vial"></i> Blood Groups</button>
  </div>

  <div id="bb-chat-input-row">
    <input type="text" id="bb-input" placeholder="Type in Urdu or English..." onkeydown="if(event.key==='Enter') sendChat()">
    <button onclick="sendChat()"><i class="fas fa-paper-plane"></i></button>
  </div>
</div>

<script>
const BB_RESPONSES = {
  "register|signup|account|saignup|account banana": {
    ur: "Register karne ke liye upar 'Register' button click karein. Donor ya Requester ka role select karein, apni details bharein aur submit karein. <i class='fas fa-check-circle' style='color:#27ae60'></i>",
    en: "Click the 'Register' button at the top. Choose your role (Donor or Requester), fill in your details and submit. <i class='fas fa-check-circle' style='color:#27ae60'></i>"
  },
  "login|signin|sign in": {
    ur: "Login karne ke liye upar 'Login' button dabayein aur apna email aur password enter karein. <i class='fas fa-lock' style='color:#BF1A1A'></i>",
    en: "Click 'Login' at the top, enter your email and password. <i class='fas fa-lock' style='color:#BF1A1A'></i>"
  },
  "donat|khoon|blood den|blood do|donate": {
    ur: "Blood donate karne ke liye: Register karein — Donor role chunein — Admin approve karega — Phir aap available donors list mein aayenge. <i class='fas fa-heart' style='color:#BF1A1A'></i>",
    en: "To donate blood: Register — Choose Donor role — Admin approves — You appear in the donor list. <i class='fas fa-heart' style='color:#BF1A1A'></i>"
  },
  "emergency|urgent|zaroorat": {
    ur: "Emergency ke liye: Login karein — Dashboard mein Emergency Request click karein — Blood group aur hospital fill karein. Hum foran donors ko notify karenge! <i class='fas fa-ambulance' style='color:#BF1A1A'></i>",
    en: "For emergency: Login — Click Emergency Request in dashboard — Fill blood group and hospital. We will notify donors immediately! <i class='fas fa-ambulance' style='color:#BF1A1A'></i>"
  },
  "blood group|blood type|group": {
    ur: "Hum ye blood groups handle karte hain: A+, A-, B+, B-, O+, O-, AB+, AB-. Sab available hain! <i class='fas fa-tint' style='color:#BF1A1A'></i>",
    en: "We handle these blood groups: A+, A-, B+, B-, O+, O-, AB+, AB-. All available! <i class='fas fa-tint' style='color:#BF1A1A'></i>"
  },
  "eligib|kaun de sakta|kon|age|umr|weight|wazan": {
    ur: "Donate karne ke liye: Umr 18-60 saal, wazan 50kg se zyada, sehat theek honi chahiye, aakhri 6 mahine mein koi badi surgery nahi. <i class='fas fa-user-check' style='color:#BF1A1A'></i>",
    en: "To donate: Age 18-60, weight above 50kg, good health, no major surgery in last 6 months. <i class='fas fa-user-check' style='color:#BF1A1A'></i>"
  },
  "kitni baar|how often|frequency|3 month|teen mahine": {
    ur: "Aap har 3 mahine baad blood donate kar sakte hain. <i class='fas fa-sync-alt' style='color:#BF1A1A'></i>",
    en: "You can donate blood every 3 months. <i class='fas fa-sync-alt' style='color:#BF1A1A'></i>"
  },
  "camp|event|upcoming|program": {
    ur: "Upcoming donation camps neeche Donation Camps section mein dekh sakte hain. Register Now button se join ho sakte hain! <i class='fas fa-calendar-alt' style='color:#BF1A1A'></i>",
    en: "Check the Upcoming Donation Camps section on the homepage. Click Register Now to join! <i class='fas fa-calendar-alt' style='color:#BF1A1A'></i>"
  },
  "contact|rabta|phone|email": {
    ur: "Hum se rabta karein: <i class='fas fa-phone' style='color:#BF1A1A'></i> +92 3028416312 ya <i class='fas fa-envelope' style='color:#BF1A1A'></i> bloodbridge@gmail.com — ya Contact page visit karein.",
    en: "Contact us: <i class='fas fa-phone' style='color:#BF1A1A'></i> +92 3028416312 or <i class='fas fa-envelope' style='color:#BF1A1A'></i> bloodbridge@gmail.com — or visit our Contact page."
  },
  "thank|shukriya|jazak": {
    ur: "Aapka shukriya! Koi aur sawaal ho tou zaroor poochein. <i class='fas fa-smile' style='color:#BF1A1A'></i>",
    en: "You are welcome! Feel free to ask anything else. <i class='fas fa-smile' style='color:#BF1A1A'></i>"
  },
  "hello|hi|assalam|salam|hey": {
    ur: "Wa Alaikum Assalam! <i class='fas fa-hand-sparkles' style='color:#BF1A1A'></i> Main aapki kaise madad kar sakta hun?",
    en: "Hello! <i class='fas fa-hand-sparkles' style='color:#BF1A1A'></i> How can I help you today?"
  }
};

function detectLang(text) {
  const urduChars = /[\u0600-\u06FF]/;
  const urduWords = /\b(kaise|kya|kaun|mujhe|chahiye|karna|karein|hai|hain|nahin|nahi|aur|ya|ko|se|mein|ka|ki|ke|ap|aap|hum|yeh|woh|shukriya|zaroor|dena|dein|len|pooch|puchna|batao|batain)\b/i;
  return urduChars.test(text) || urduWords.test(text) ? 'ur' : 'en';
}

function getReply(msg) {
  const lower = msg.toLowerCase();
  for (const [pattern, resp] of Object.entries(BB_RESPONSES)) {
    const keys = pattern.split("|");
    if (keys.some(k => lower.includes(k))) {
      const lang = detectLang(msg);
      return resp[lang] || resp['en'];
    }
  }
  const lang = detectLang(msg);
  return lang === 'ur'
    ? "Maafi chahta hun, main is sawaal ka jawab nahi de sakta. Meherbani karke <a href='contact.php'><i class='fas fa-envelope'></i> Contact</a> page visit karein ya <i class='fas fa-phone'></i> +92 3028416312 call karein."
    : "Sorry, I could not understand that. Please visit our <a href='contact.php'><i class='fas fa-envelope'></i> Contact</a> page or call <i class='fas fa-phone'></i> +92 3028416312.";
}

function appendMsg(text, type) {
  const box = document.getElementById('bb-chat-messages');
  const div = document.createElement('div');
  div.className = 'bb-msg ' + type;
  div.innerHTML = text;
  box.appendChild(div);
  box.scrollTop = box.scrollHeight;
}

function sendChat() {
  const inp = document.getElementById('bb-input');
  const msg = inp.value.trim();
  if (!msg) return;
  appendMsg(msg, 'user');
  inp.value = '';
  document.getElementById('bb-quick-btns').style.display = 'none';
  setTimeout(() => {
    appendMsg('<i class="fas fa-spinner fa-spin" style="color:#BF1A1A"></i>', 'bot typing-wrap');
    setTimeout(() => {
      document.querySelector('.typing-wrap')?.remove();
      appendMsg(getReply(msg), 'bot');
    }, 900);
  }, 200);
}

function quickAsk(q) {
  document.getElementById('bb-input').value = q;
  sendChat();
}

function toggleChat() {
  const win = document.getElementById('bb-chat-window');
  const bubble = document.getElementById('bb-chat-bubble');
  const isOpen = win.classList.contains('open');
  win.classList.toggle('open');
  bubble.style.display = isOpen ? 'flex' : 'none';
}
</script>

</body>
</html>
