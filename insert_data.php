<?php 
ini_set('display_errors', 1); error_reporting(-1);
include("dbcon.php");
date_default_timezone_set('America/Toronto');

if(isset($_POST['add_item'])){
    $part_number = $_POST['item_part_number'];
    $serial_number = $_POST['item_serial_number'];
    $name = $_POST['item_name'];
    $quantity = $_POST['item_quantity'];
    $minimum = $_POST['item_minimum'];
    $division = $_POST['item_division'];
    $shelf = $_POST['item_shelf'];
    $level = $_POST['item_level'];
    $zone = $_POST['item_zone'];
    $depth = $_POST['item_depth'];
    $note = $_POST['item_note'];
    $creation_time = date('Y-m-d h:i a', time());
    $last_edited = date('Y-m-d h:i a', time());
    $query = "INSERT INTO `inventory`(`part_number`, `serial_number`, `name`, `quantity`, `minimum`, `division`, `shelf`, `level`, `zone`, `depth`,`last_audited`, `creation_time`, `last_edited`, `note`) VALUES ('$part_number', '$serial_number', '$name', '$quantity', '$minimum', '$division', '$shelf', '$level', '$zone' ,'$depth','','$creation_time','$last_edited','$note')";
    
    try{
        $result = mysqli_query($connection, $query);
    } catch (Throwable $exception) { //Use Throwable to catch both errors and exceptions
        // Other problems 
        header("location:index.php?error= Error 500: Failed to add.($serial_number , $name) Please check the uniqueness of the id.");
    }
    // $result = mysqli_query($connection, $query);
    // $mysqli -> close();
    
    //Problem in sql query.
    if (!$result){
        $log_date = date('Y-m-d h:i:s a', time());
        $query = "INSERT INTO `Logs`(`date`, `action`, `person`, `Note`) VALUES ('$log_date',' Failed to Add ($serial_number , $name). Please check the uniqueness of the id.','Admin','')";
        $result = mysqli_query($connection,$query);
        
        header("location:index.php?error= Error 500: Failed to add.($serial_number , $name) Please check the uniqueness of the id.");
        die("Failed to insert data.");
    }
    
    // Item stored in database
    else {
        $date = date('Y-m-d h:i a', time());
        $log_date = date('Y-m-d h:i:s a', time());
        $query = "INSERT INTO `Logs`(`date`, `action`, `person`, `Note`) VALUES ('$log_date','Added ($serial_number , $name)','Admin','')";
        $result = mysqli_query($connection,$query);
        header("location:index.php?add_message=Added: ($serial_number , $name) ($date).");
    }




}

