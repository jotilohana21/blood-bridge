<?php
include "db.php";
session_start();

if(isset($_POST['submit'])){
    $user_id = $_SESSION['user_id'];
    $blood_group = $_POST['blood_group'];
    $units = $_POST['units'];
    $hospital = $_POST['hospital'];
    $message = $_POST['message'];

    $query = "INSERT INTO emergency_requests 
          (user_id, blood_group, units, hospital, message, is_emergency, status)
          VALUES
          ('$user_id','$blood_group','$units','$hospital','$message', 1, 'Pending')";

    mysqli_query($conn,$query);

    // 🔔 NOTIFY ADMIN
     $notif_msg = "🚨 New emergency blood request received";

    mysqli_query($conn,
             "INSERT INTO notifications (user_role, message, status)
              VALUES ('admin', '$notif_msg', 'Unread')"
            );

    header("Location: requester_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Emergency Blood Request</title>
    <link rel="stylesheet" href="emergency-request.css">
</head>
<body>

<div class="emergency-wrapper">

    <!-- LEFT IMAGE -->
    <div class="emergency-image">
        <img src="images/emergency_blood.png" alt="Emergency">
    </div>

    <!-- RIGHT FORM -->
    <div class="emergency-form">
        <h2>Emergency Blood Request</h2>
        <p>Please fill details for urgent blood need</p>

        <form method="POST">

            <label>Blood Group</label>
            <select name="blood_group" required>
                <option value="">Select</option>
                <option>A+</option><option>A-</option>
                <option>B+</option><option>B-</option>
                <option>O+</option><option>O-</option>
                <option>AB+</option><option>AB-</option>
            </select>

            <label>Required Units</label>
            <input type="number" name="units" required>

            <label>Hospital / Location</label>
            <input type="text" name="hospital" required>

            <label>Message</label>
            <textarea name="message" rows="4"></textarea>

            <button type="submit" name="submit">
                Submit Emergency Request
            </button>

        </form>
    </div>

</div>

</body>
</html>
