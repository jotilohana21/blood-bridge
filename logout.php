<?php
session_start();

/* UNSET all session variables */
session_unset();

/* DESTROY the session */
session_destroy();

/* Redirect to login */
header("Location: login.php");
exit();
?>
