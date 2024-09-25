<?php
$dbserver = "localhost"; // Your database server (usually localhost)
$dbuser = "root";
$dbpass = "";
$dbname = "registrationdb"; // Your database name


$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
