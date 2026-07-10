<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$id = intval($_GET['id']);
if ($id <= 0) { header("Location: admin_dashboard.php"); exit(); }

mysqli_query($conn, "UPDATE emergency_requests SET donor_status='Confirmed' WHERE id='$id'");

header("Location: admin_dashboard.php");
exit();
?>