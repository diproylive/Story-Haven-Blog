<?php
$server = "localhost";
$user = "root";
$pass ="";
$db = "blogs";

$con = mysqli_connect($server,$user,$pass,$db);

if (!$con) {
    die("Connection failed: ". mysqli_connect_error());
}
?>