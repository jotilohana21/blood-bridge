<?php
session_start();
include "db.php";

/* ADMIN CHECK */
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn,
    "SELECT * FROM blood_inventory WHERE id='$id'"
);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $units = $_POST['units'];

    mysqli_query($conn,
        "UPDATE blood_inventory SET units='$units' WHERE id='$id'"
    );

    header("Location: admin_dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Inventory</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="edit-inventory.css">
</head>
<body>

<div class="edit-container">
    <form method="post" class="edit-form">

        <h2>Edit Blood Inventory</h2>

        <div class="blood-preview">
            <i class="fa-solid fa-droplet"></i>
            <h3><?= $row['blood_group']; ?></h3>
        </div>

        <label>Units Available</label>
        <input type="number" name="units"
               value="<?= $row['units']; ?>"
               min="0" required>

        <div class="form-actions">
            <button type="submit" name="update" class="btn-save">
                Update Units
            </button>

            <a href="admin_dashboard.php" class="btn-cancel">
                Cancel
            </a>
        </div>

    </form>
</div>

</body>
</html>
