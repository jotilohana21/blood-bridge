<?php
session_start();
include "db.php";

$success = "";
$error = "";

if (isset($_POST['register'])) {

    $name  = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role  = mysqli_real_escape_string($conn, $_POST['role']);
    $blood = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $pass  = $_POST['password'];
    $cpass = $_POST['confirm_password'];

    if ($pass !== $cpass) {
        $error = "Passwords do not match!";
    } else {

        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        // CHECK EMAIL
        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Email already registered!";
        } else {

            // INSERT INTO USERS
            $insertUser = "INSERT INTO users 
            (full_name, email, phone, blood_group, password, role)
            VALUES 
            ('$name', '$email', '$phone', '$blood', '$hashedPassword', '$role')";

            if (mysqli_query($conn, $insertUser)) {

                // 👉 AGAR REQUESTER HAI TO BLOOD REQUEST AUTO CREATE
                if ($role == 'requester') {

                    $insertRequest = "INSERT INTO blood_requests 
                    (patient_name, email, blood_group, status)
                    VALUES 
                    ('$name', '$email', '$blood', 'Pending')";

                    mysqli_query($conn, $insertRequest);

                    // 🔔 ADMIN NOTIFICATION
                    $notify = "INSERT INTO notifications (user_role, message)
                    VALUES ('admin', 'New blood request from $name ($blood)')";

                   mysqli_query($conn, $notify);
                }

                $success = "Registration successful! You can login now.";
                header("refresh:2;url=login.php");

            } else {
                $error = "User insert failed!";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | Blood Bridge</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="register.css">
</head>

<body>

<div class="register-wrapper">

  <!-- LEFT INFO PANEL -->
  <div class="register-left">
    <h1>Join Blood Bridge</h1>
    <p>
      Become a part of a life-saving community.  
      Register as a donor or requester and help save lives.
    </p>

    <ul class="benefits">
      <li><i class="fas fa-check-circle"></i> Verified donor network</li>
      <li><i class="fas fa-check-circle"></i> Fast emergency requests</li>
      <li><i class="fas fa-check-circle"></i> Secure & reliable system</li>
    </ul>

    <img src="Images/register-illustration.png" alt="Register Illustration">
  </div>

  <!-- RIGHT FORM PANEL -->
  <div class="register-right">
    <h2>Create Account</h2>
    <p class="subtitle">Fill the form to get started</p>

    <!-- SUCCESS / ERROR MESSAGE HERE -->
  <?php if ($error): ?>
    <p style="color:red; margin-bottom:10px;"><?php echo $error; ?></p>
  <?php endif; ?>

  <?php if ($success): ?>
    <p style="color:green; margin-bottom:10px;"><?php echo $success; ?></p>
  <?php endif; ?>

    <form class="register-form" method="POST" action="">

      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="full_name" placeholder="Full Name" required>
      </div>

      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" placeholder="Email Address" required>
      </div>

      <div class="input-group">
        <i class="fas fa-phone"></i>
        <input type="text" name="phone" placeholder="Phone Number" required>
      </div>

      <div class="input-group">
         <i class="fas fa-users"></i>
      <select name="role" required>
          <option selected disabled>Select Role</option>
          <option value="donor">Donor</option>
          <option value="requester">Requester</option>
     </select>
     </div>

      <div class="input-group">
        <i class="fas fa-droplet"></i>
        <select name="blood_group" required>
          <option selected disabled>Blood Group</option>
          <option>A+</option><option>A-</option>
          <option>B+</option><option>B-</option>
          <option>AB+</option><option>AB-</option>
          <option>O+</option><option>O-</option>
        </select>
      </div>

      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
      </div>

      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      </div>

      <button type="submit" name="register" class="register-btn">
        <i class="fas fa-user-plus"></i> Create Account
      </button>

      <p class="login-link">
        Already have an account?
        <a href="login.php">Login here</a>
      </p>

    </form>
  </div>

</div>

</body>
</html>
