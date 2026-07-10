<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$donor = mysqli_query($conn, "SELECT * FROM users WHERE id='$id' AND role='donor'");
$data = mysqli_fetch_assoc($donor);

if (isset($_POST['update_donor'])) {

    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $blood = mysqli_real_escape_string($conn, $_POST['blood']);

    $update = "UPDATE users SET
        full_name='$name',
        email='$email',
        blood_group='$blood'
        WHERE id='$id'";

    mysqli_query($conn, $update);

    header("Location: admin_dashboard.php?updated=1");
    exit();
}
?>


<form method="POST">

<h2>Edit Donor</h2>

<label>Full Name</label>
<input type="text" name="name" value="<?= $data['full_name'] ?>" required>

<label>Email</label>
<input type="email" name="email" value="<?= $data['email'] ?>" required>

<label>Blood Group</label>
<select name="blood" required>
    <option><?= $data['blood_group'] ?></option>
    <option>A+</option><option>A-</option>
    <option>B+</option><option>B-</option>
    <option>AB+</option><option>AB-</option>
    <option>O+</option><option>O-</option>
</select>

<button type="submit" name="update_donor">
   Update Donor
</button>

</form>
