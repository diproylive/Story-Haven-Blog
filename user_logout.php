<?php

include 'includes/connect.php';
session_start();

//session_unset();

session_destroy();

echo '<script>alert("Are you sure you want to Logout?");</script>';

header('location:user_login.php');
exit();

?>