<?php
include("database_connect.php");
date_default_timezone_set('America/Toronto'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// From the index page
//  Store person and note
$person = $_POST["person"];
$note = $_POST["note"];

// Note: 

// A new log without person and note was created after doing update, insert or delete  (Only id, action, name)
// We updating person and note to the created log here, instead of providing them initially

// Reason:
// We called show_popup() within update_data(); 
// the show_popup(), shows the div and ends the function;
// the update_data() is running while people is filling their name and note.
// Which means update is already happened and new log is created without the name and note.
// Once people finished filling, we then update the log with the name and the note.


$query = "UPDATE `ITM_Logs` SET `person` = '$person', `note` = '$note' ORDER BY `id` DESC LIMIT 1;";

mysqli_query($connect, $query);
?>