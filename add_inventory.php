<?php
session_start();
include "db.php";

/* ADMIN CHECK */
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

/* FORM SUBMIT */
if (isset($_POST['add_units'])) {

    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $units = (int) $_POST['units'];

    /* CHECK: blood group already exists? */
    $check = mysqli_query($conn,
        "SELECT * FROM blood_inventory WHERE blood_group='$blood_group'"
    );

    if (mysqli_num_rows($check) > 0) {

        /* UPDATE existing blood group */
        mysqli_query($conn,
            "UPDATE blood_inventory
             SET units = units + $units
             WHERE blood_group='$blood_group'"
        );

    } else {

        /* INSERT new blood group */
        mysqli_query($conn,
            "INSERT INTO blood_inventory (blood_group, units)
             VALUES ('$blood_group', '$units')"
        );
    }

    /* Redirect back */
    header("Location: admin_dashboard.php?inventory=updated");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Blood Inventory | Blood Bridge</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="add-inventory.css">
</head>
<body>

<div class="inventory-wrapper">

    <div class="inventory-card">

        <h2>
            <i class="fa-solid fa-droplet"></i>
            Add Blood Inventory
        </h2>

        <p class="subtitle">
            Update available blood units in the system
        </p>

        <form method="POST">

            <!-- Blood Group -->
            <div class="input-group">
                <label>Blood Group</label>
                <select name="blood_group" required>
                    <option value="">Select Blood Group</option>
                    <option>A+</option>
                    <option>A-</option>
                    <option>B+</option>
                    <option>B-</option>
                    <option>AB+</option>
                    <option>AB-</option>
                    <option>O+</option>
                    <option>O-</option>
                </select>
            </div>

            <!-- Units -->
            <div class="input-group">
                <label>Units</label>
                <input type="number" name="units" min="1" placeholder="Enter units" required>
            </div>

            <!-- Button -->
            <button type="submit" name="add_units">
                <i class="fa-solid fa-plus"></i>
                Add Units
            </button>

        </form>

        <a href="admin_dashboard.php" class="back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Dashboard
        </a>

    </div>

</div>

</body>
</html>
