<?php
include("database_connect.php");
date_default_timezone_set('America/Toronto'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// From the index page
//  Store person and note
// if ($_SESSION["process_log"] == "log_round_1"){
//     session_start();
// $_SESSION["person"] = $_POST["person"];
// $_SESSION["note"] = $_POST["note"];

// $_SESSION["process_log"] = "";

// }

// From update page and insert page
// Store action, id, name
// Add log
if ($_SESSION["process_log"] == "log_round_2"){
    // session_start();
    $log_action = $_SESSION["log_action"];
    $action_item_id = $_SESSION["action_item_id"];
    $action_item_name = $_SESSION["action_item_name"];
    // print_r($_SESSION["note"]);
    // echo $_SESSION["person"];
    // echo "<script>console.log('h')</script>";
    $note = $_SESSION["note"];
    $person = $_SESSION["person"];
    $log_date = date('Y-m-d h:i:s a', time());
    $query = "INSERT INTO `ITM_Logs`(`date`, `person`,`action`,`note`) VALUES ('$log_date','$person','$log_action ( $action_item_id , $action_item_name)','$note')";
    $result = mysqli_query($connect,$query);
    // '$note'
    $_SESSION["person"] = "";
    $_SESSION["note"] = "";
    $_SESSION["log_action"] = "";
    $_SESSION["action_item_id"] = "";
    $_SESSION["action_item_name"] = "";
}


// ?>
