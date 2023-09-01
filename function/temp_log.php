<?php
include("/Applications/XAMPP/xamppfiles/htdocs/Real_Time_Inventory/header.php");
include("database_connect.php");
date_default_timezone_set('America/Toronto'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// From the index page
//  Store person and note
// if ($_SESSION["process_log"] == "log_round_1"){

$_SESSION["person"] = $_POST["person"];
$_SESSION["note"] = $_POST["note"];
echo $_SESSION["person"];
echo $_SESSION["note"];
$_SESSION["process_log"] = "";

// }
?>