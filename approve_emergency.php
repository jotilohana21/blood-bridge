<?php
session_start();
include "db.php";

if($_SESSION['role'] != 'admin'){
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];

/* FETCH REQUEST */
$q = mysqli_query($conn,
  "SELECT * FROM emergency_requests WHERE id='$id'"
);
$e = mysqli_fetch_assoc($q);

/* APPROVE */
mysqli_query($conn,
  "UPDATE emergency_requests
   SET status='Accepted'
   WHERE id='$id'"
);

/* NOTIFY REQUESTER */
$user_id = $e['user_id'];

$user = mysqli_query($conn,
  "SELECT email FROM users WHERE id='$user_id'"
);
$u = mysqli_fetch_assoc($user);

$message = "Your emergency blood request has been Approved";

mysqli_query($conn,
  "INSERT INTO notifications (user_role, email, message, status)
   VALUES ('requester', '{$u['email']}', '$message', 'Unread')"
);

header("Location: admin_dashboard.php");
exit();
?>