<?php
include("db.php");

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {

        $error = "Please fill all fields!";

    } else {

        // 1️⃣ Insert contact message
        $sql = "INSERT INTO contact_messages (name, email, message, status)
                VALUES ('$name', '$email', '$message', 'Unread')";

        if (mysqli_query($conn, $sql)) {

            // 2️⃣ 🔔 INSERT NOTIFICATION (YAHAN ADD KARNA THA)
            $notif = "INSERT INTO notifications (user_role, message, status)
                      VALUES ('admin', 'New contact message received', 'Unread')";
            mysqli_query($conn, $notif);

            $success = "Your message has been sent successfully!";

        } else {
            $error = "Something went wrong. Try again!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us | Blood Bridge</title>

  <!-- Font Awesome -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="contact.css">
</head>
<body>

<!-- NAVBAR -->
<header class="navbar">
  <div class="container nav-inner">

    <div class="brand">
      <img src="Images/Blood-logo.jpeg" class="logo-img">
      <span class="brand-text">Blood Bridge</span>
    </div>

    <nav class="menu">
      <a href="index.php">Home</a>
      <a href="donor_dashboard.php">Donors</a>
      <a href="requester_dashboard.php">Request</a>
      <a href="about.html">About</a>
      <a href="contact.php" class="active">Contact</a>
    </nav>

    <div class="auth">
      <a href="login.php" class="btn-outline">Login</a>
      <a href="register.php" class="btn-primary small">Register</a>
    </div>

  </div>
</header>

<!-- HERO -->
<section class="contact-hero">
  <div class="hero-content">

    <div class="hero-text fade-in">
      <h1>Contact Us</h1>
      <p>
        Whether you need urgent blood assistance or want to collaborate with us,
        Blood Bridge is always here to help.  
        Your single message can become a reason to save a precious life.
      </p>
    </div>

    <div class="hero-image slide-right">
      <img src="Images/contact-illustration.png" alt="Contact Illustration">
    </div>

  </div>
</section>

<!-- INFO CARDS -->
<section class="contact-info">
  <div class="info-card">
    <i class="fa-solid fa-phone"></i>
    <h3>Call Us</h3>
    <p>+92 302 8416312</p>
  </div>

  <div class="info-card">
    <i class="fa-solid fa-envelope"></i>
    <h3>Email</h3>
    <p>bloodbridge@gmail.com</p>
  </div>

  <div class="info-card">
    <i class="fa-solid fa-location-dot"></i>
    <h3>Location</h3>
    <p>SBA, Sindh, Pakistan</p>
  </div>
</section>

<!-- MAIN CONTACT -->
<section class="contact-main">

  <!-- FORM -->
  <div class="contact-form fade-in">
    <h2>Get In Touch</h2>
    <p class="form-desc">
      Feel free to send us your queries, feedback, or blood requests.
      Our team will respond as soon as possible.
    </p>

    <form method="POST" action="">

    <?php if($success): ?>
        <p style="color:green; font-weight:600;"><?php echo $success; ?></p>
    <?php endif; ?>

    <?php if($error): ?>
        <p style="color:red; font-weight:600;"><?php echo $error; ?></p>
    <?php endif; ?>

      <input type="text" name="name" placeholder="Your Name" required>
      <input type="email" name="email" placeholder="Your Email" required>
      <textarea name="message" placeholder="Your Message" required></textarea>
      <button type="submit" name="send">Send Message</button>
    </form>
  </div>

  <!-- MAP -->
  <div class="contact-map fade-in">
    <h2>Our Location</h2>
    <p class="map-desc">
      You can visit or reach us at our registered location shown below.
    </p>

    <iframe
      src="https://www.google.com/maps?q=SBA%20Sindh%20Pakistan&output=embed"
      loading="lazy">
    </iframe>
  </div>

</section>

<!-- FOOTER -->
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

</body>
</html>
