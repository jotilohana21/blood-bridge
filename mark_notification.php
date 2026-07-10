<?php
include "db.php";

$id = $_GET['id'];

mysqli_query($conn,
"UPDATE notifications SET status='Read' WHERE id=$id");

header("Location: admin_dashboard.php");
exit();
?>