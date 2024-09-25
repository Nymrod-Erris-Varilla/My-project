<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Clear the cookies
setcookie('authToken', '', time() - 3600, "/");
setcookie('username', '', time() - 3600, "/");
setcookie('rememberMe', '', time() - 3600, "/");

// Redirect to the login page
header("Location: index.php");
exit();
?>
