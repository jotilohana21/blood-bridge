<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$msg = "";

if (isset($_POST['add_donor'])) {

    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $blood = mysqli_real_escape_string($conn, $_POST['blood']);
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Email duplicate check
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $msg = "Email already exists!";
    } else {

        $query = "INSERT INTO users
            (full_name, email, password, role, blood_group)
            VALUES
            ('$name', '$email', '$pass', 'donor', '$blood')";

        if (mysqli_query($conn, $query)) {
            header("Location: admin_dashboard.php?success=donor_added");
            exit();
        } else {
            $msg = "Something went wrong!";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Donor | Blood Bridge</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="add-donor.css">
</head>
<body>

<div class="form-container">

    <!-- HEADER -->
    <div class="form-header">
        <i class="fa-solid fa-user-plus"></i>
        <h2>Add New Donor</h2>
        <p>Register a new blood donor in the system</p>
    </div>

    <!-- FORM -->
    <form method="POST">

<div class="input-group">
    <label>Full Name</label>
    <div class="input-box">
        <i class="fa-solid fa-user"></i>
        <input type="text" name="name" required>
    </div>
</div>

<div class="input-group">
    <label>Email</label>
    <div class="input-box">
        <i class="fa-solid fa-envelope"></i>
        <input type="email" name="email" required>
    </div>
</div>

<div class="input-group">
    <label>Blood Group</label>
    <div class="input-box">
        <i class="fa-solid fa-droplet"></i>
        <select name="blood" required>
            <option value="">Select</option>
            <option>A+</option><option>A-</option>
            <option>B+</option><option>B-</option>
            <option>AB+</option><option>AB-</option>
            <option>O+</option><option>O-</option>
        </select>
    </div>
</div>

<div class="input-group">
            <label>Contact Number</label>
            <div class="input-box">
                <i class="fa-solid fa-phone"></i>
                <input type="text" placeholder="Enter contact number">
            </div>
</div>

<div class="input-group">
    <label>Password</label>
    <div class="input-box">
        <i class="fa-solid fa-lock"></i>
        <input type="password" name="password" required>
    </div>
</div>

<?php if($msg){ ?>
<p style="color:red;text-align:center"><?= $msg ?></p>
<?php } ?>

<div class="btn-group">
    <button type="submit" name="add_donor" class="btn primary">
        <i class="fa-solid fa-circle-plus"></i> Add Donor
    </button>

    <a href="admin_dashboard.php" class="btn secondary">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
</div>

</form>


</div>

</body>
</html>
