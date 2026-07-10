<?php
include "db.php";
session_start();

$donor_id = $_SESSION['user_id'];
$request_id = $_GET['id'];

/* Update emergency request */
mysqli_query($conn, 
"UPDATE emergency_requests
 SET donor_id = '$donor_id',
     donor_status = 'Accepted',
     status = 'Donor Accepted'
 WHERE id = '$request_id'"
);

/* Notify Admin */
mysqli_query($conn, 
"INSERT INTO notifications (user_role, message, status)
 VALUES (
   'admin',
   'A donor has accepted an emergency request. Please review donor details.',
   'Unread'
 )"
);

header("Location: donor_dashboard.php?accepted=1");
exit();
?>
