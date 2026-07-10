<?php
include 'db.php';

$request_id = intval($_GET['id']);
if ($request_id <= 0) { header("Location: admin_dashboard.php"); exit(); }

$q = mysqli_query($conn,
"SELECT er.*, 
        r.email AS requester_email,
        d.full_name, d.email, d.phone, d.blood_group
 FROM emergency_requests er
 JOIN users r ON er.user_id = r.id
 JOIN users d ON er.donor_id = d.id
 WHERE er.id='$request_id'
");

$data = mysqli_fetch_assoc($q);

mysqli_query($conn,
"INSERT INTO notifications (user_role, email, message, status)
 VALUES (
   'requester',
   '{$data['requester_email']}',
   'Admin has shared donor details for your emergency request.',
   'Unread'
 )"
);

mysqli_query($conn,
"UPDATE emergency_requests
 SET status='Approved'
 WHERE id='$request_id'
");

header("Location: admin_dashboard.php");
exit();
?>