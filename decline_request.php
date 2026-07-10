<?php
include 'db.php';
session_start();

$request_id = $_GET['id'];

mysqli_query($conn,
"UPDATE emergency_requests
 SET donor_status='Declined', status='Pending', donor_id=NULL
 WHERE id='$request_id'"
);

mysqli_query($conn,
"INSERT INTO notifications (user_role, message, status)
VALUES ('admin','A donor declined an emergency request','Unread')
");

header("Location: donor_dashboard.php");
exit();
?>
