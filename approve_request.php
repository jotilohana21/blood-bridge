<?php
session_start();
include "db.php";

/* ADMIN CHECK */
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

/* REQUEST ID */
$id = intval($_GET['id']);
if ($id <= 0) { header("Location: admin_dashboard.php"); exit(); }

/* 1. REQUEST DATA FETCH */
$request = mysqli_query($conn,
   "SELECT * FROM blood_requests WHERE id='$id'"
);

$r = mysqli_fetch_assoc($request);

$blood_group = $r['blood_group'];
$requester_email = $r['email'];   

/* 2. CHECK INVENTORY */
$inventory = mysqli_query($conn,
   "SELECT * FROM blood_inventory WHERE blood_group='$blood_group'"
);

$inv = mysqli_fetch_assoc($inventory);

/* 3. IF UNITS AVAILABLE */
if ($inv && isset($inv['units']) && $inv['units'] > 0)
 {

    /* REDUCE 1 UNIT */
    mysqli_query($conn,
      "UPDATE blood_inventory
       SET units = units - 1
       WHERE blood_group='$blood_group'"
    );

    /* APPROVE REQUEST */
    mysqli_query($conn,
      "UPDATE blood_requests
       SET status='Approved'
       WHERE id='$id'"
    );

    $message = "Your blood request for $blood_group has been Approved.";

    mysqli_query($conn,
 "INSERT INTO notifications (user_role, email, message, status)
  VALUES ('requester', '$requester_email', '$message', 'Unread')"
);

} else {

    /* NOT ENOUGH BLOOD → REJECT */
    mysqli_query($conn,
      "UPDATE blood_requests
       SET status='Rejected'
       WHERE id='$id'"
    );

    /* 🔔 NOTIFICATION (REJECTED) */
    $message = "Your blood request for $blood_group has been Rejected.";

    mysqli_query($conn,
 "INSERT INTO notifications (user_role, email, message, status)
  VALUES ('requester', '$requester_email', '$message', 'Unread')"
);

}

/* BACK TO DASHBOARD */
header("Location: admin_dashboard.php");
exit();
?>
