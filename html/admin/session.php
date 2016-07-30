<?php
include('../config.php');
session_start();
$loggedIn = $_SESSION['loggedIn'];
if (!isset($_SESSION['loggedIn'])) {
    header("location: login.php");
}
?>
