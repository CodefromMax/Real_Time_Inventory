<?php
include("database_connect.php");
date_default_timezone_set('America/Toronto');
$sql = "INSERT INTO `ITM_Inventory` (`Item_Name`, `Supplier`, `Est_Quantity`, `Exact_Quantity`, `Minimum`, `Boxes`, `Owner_Name`, `Status`, `Room`, `Section`, `Shelf`, `Level`, `Note`) VALUES('".$_POST["Item_Name"]."', '".$_POST["Supplier"]."', '".$_POST["Est_Quantity"]."', '".$_POST["Exact_Quantity"]."', '".$_POST["Minimum"]."', '".$_POST["Boxes"]."', '".$_POST["Owner_Name"]."', '".$_POST["Status"]."', '".$_POST["Room"]."', '".$_POST["Section"]."', '".$_POST["Shelf"]."', '".$_POST["Level"]."', '".$_POST["Note"]."')";
if(mysqli_query($connect, $sql)){
echo 'Data Inserted';
}

$Item = $_POST["Item_Name"];
$_SESSION["log_action"] = "Added";
$_SESSION["action_item_id"] = "Auto Generated";
$_SESSION["action_item_name"] = $Item;
include("add_log.php");


?>
