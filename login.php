<?php
session_start();
include "db.php";

$error = "";

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // SELECT query
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {

            // Sessions
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email']     = $user['email'];

            // Role based redirect
            if ($user['role'] == 'donor') {
                header("Location: donor_dashboard.php");
            } 
            elseif ($user['role'] == 'requester') {
                header("Location: requester_dashboard.php");
            } 
            elseif ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            }
            exit();

        } else {
            $error = "Incorrect password!";
        }

    } else {
        $error = "Email not found!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Blood Bridge</title>

    <!-- CSS -->
    <link rel="stylesheet" href="login.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="login-wrapper">

    <!-- LEFT SIDE -->
    <div class="login-left">
        <img src="Images/login-illustration.png" alt="Blood Donation">
        <h2>Blood Bridge</h2>
        <p>Connecting donors with lives that need saving.</p>
    </div>

    <!-- RIGHT SIDE -->
    <div class="login-right">
        <h1>Hello Again 👋</h1>
        <p class="subtitle">Welcome back, you've been missed</p>

        <form class="login-form" method="POST" action="">

        <?php if ($error != "") { ?>
        <p style="color:red; margin-bottom:10px;"><?php echo $error; ?></p>
        <?php } ?>

            <div class="input-box">
                <i class="fa-solid fa-envelope"></i>
                <input type="text" name="email" placeholder="Email or Username" required>
            </div>

            <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="options">
                <a href="#">Recovery Password</a>
            </div>

            <button type="submit" name="login" class="login-btn">Sign In</button>

            <p class="or">Or continue with</p>

            <div class="social-login">
                <span><i class="fa-brands fa-google"></i></span>
                <span><i class="fa-brands fa-facebook-f"></i></span>
                <span><i class="fa-brands fa-apple"></i></span>
            </div>

            <p class="register-text">
                Don’t have an account?
                <a href="register.php">Register now</a>
            </p>

        </form>
    </div>

</div>

</body>
</html>
