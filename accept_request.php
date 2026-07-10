<?php 
session_start(); 
include 'db.php'; 
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'donor') { 
    header("Location: login.php"); 
    exit();
 } 
    $donor_id = $_SESSION['user_id']; 
    $request_id = $_GET['id']; 
    /* Update emergency request */ 
    mysqli_query($conn, 
    "UPDATE emergency_requests SET status='Accepted', donor_id='$donor_id' WHERE id='$request_id' "); 
    /* Notify admin (notification table already exists) */ 
    mysqli_query($conn, 
    "INSERT INTO notifications (user_role, message, status) 
    VALUES ('admin', 'A donor has accepted an emergency blood request', 'unread') "); 
    header("Location: donor_dashboard.php"); 
    exit(); 
?>