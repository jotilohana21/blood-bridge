<?php
session_start();
include 'db.php';

$request_id = intval($_GET['id']);
if ($request_id <= 0) { header("Location: donor_dashboard.php"); exit(); }

mysqli_query($conn, "
    UPDATE emergency_requests 
    SET status='Declined'
    WHERE id='$request_id'
");

header("Location: donor_dashboard.php");
exit();
?>