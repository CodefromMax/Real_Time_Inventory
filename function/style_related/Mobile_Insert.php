<?php 
ini_set('display_errors', 1); error_reporting(-1);
include("../database_connect.php");
date_default_timezone_set('America/Toronto');



if(isset($_POST['add_item'])){
    $Item_Name = $_POST['Item_Name'];
    $Supplier = $_POST['Supplier'];
    $Est_Quantity = $_POST['Est_Quantity'];
    $Exact_Quantity = $_POST['Exact_Quantity'];
    $Minimum = $_POST['Minimum'];
    $Boxes = $_POST['Boxes'];
    $Owner_Name = $_POST['Owner_Name'];
    $Status = $_POST['Status'];
    $Room = $_POST['Room'];
    $Section = $_POST['Section'];
    $Shelf = $_POST['Shelf'];
    $Level = $_POST['Level'];
    $Note = $_POST['Note'];
    $User_Name = $_POST['Log_Name'];
    $Log_Note = $_POST['Log_Note'];
    $sql = "INSERT INTO `ITM_Inventory` (`Item_Name`, `Supplier`, `Est_Quantity`, `Exact_Quantity`, `Minimum`, `Boxes`, `Owner_Name`, `Status`, `Room`, `Section`, `Shelf`, `Level`, `Note`) VALUES('".$_POST["Item_Name"]."', '".$_POST["Supplier"]."', '".$_POST["Est_Quantity"]."', '".$_POST["Exact_Quantity"]."', '".$_POST["Minimum"]."', '".$_POST["Boxes"]."', '".$_POST["Owner_Name"]."', '".$_POST["Status"]."', '".$_POST["Room"]."', '".$_POST["Section"]."', '".$_POST["Shelf"]."', '".$_POST["Level"]."', '".$_POST["Note"]."')";
    if(mysqli_query($connect, $sql)){
        // echo 'Data Inserted';
        $Item = $_POST["Item_Name"];

        $log_date = date('Y-m-d h:i:s a', time());
        $query = "INSERT INTO `ITM_Logs`(`date`, `person`,`action`,`note`) VALUES ('$log_date','$User_Name','Added ( Auto Generated , $Item)','$Log_Note')";
        $result = mysqli_query($connect,$query);




        header('location:../../index.php');
        }


}

