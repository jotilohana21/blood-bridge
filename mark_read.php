<?php
include "db.php";

$id = $_GET['id'];

mysqli_query($conn,"UPDATE contact_messages SET status='Read' WHERE id=$id");

header("Location: admin_dashboard.php#messages");
