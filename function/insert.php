<?php
include("database_connect.php");
date_default_timezone_set('America/Toronto');
$sql = "INSERT INTO `ITM_Inventory` (`Item_Name`, `Supplier`, `Est_Quantity`, `Exact_Quantity`, `Minimum`, `Boxes`, `Owner_Name`, `Status`, `Room`, `Section`, `Shelf`, `Level`, `Note`) VALUES('".$_POST["Item_Name"]."', '".$_POST["Supplier"]."', '".$_POST["Est_Quantity"]."', '".$_POST["Exact_Quantity"]."', '".$_POST["Minimum"]."', '".$_POST["Boxes"]."', '".$_POST["Owner_Name"]."', '".$_POST["Status"]."', '".$_POST["Room"]."', '".$_POST["Section"]."', '".$_POST["Shelf"]."', '".$_POST["Level"]."', '".$_POST["Note"]."')";
if(mysqli_query($connect, $sql)){
echo 'Data Inserted';
}

// Store it in the log database
$Item = $_POST["Item_Name"];

$log_date = date('Y-m-d h:i:s a', time());
$query = "INSERT INTO `ITM_Logs`(`date`, `person`,`action`,`note`) VALUES ('$log_date','','Added ( Auto Generated , $Item)','')";
$result = mysqli_query($connect,$query);

?>
