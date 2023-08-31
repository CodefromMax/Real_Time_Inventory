<?php
include("database_connect.php");
date_default_timezone_set('America/Toronto');
$sql = "INSERT INTO `ITM_Inventory` (`Item_Name`, `Supplier`, `Est_Quantity`, `Exact_Quantity`, `Minimum`, `Boxes`, `Owner_Name`, `Status`, `Room`, `Section`, `Shelf`, `Level`, `Note`) VALUES('".$_POST["Item_Name"]."', '".$_POST["Supplier"]."', '".$_POST["Est_Quantity"]."', '".$_POST["Exact_Quantity"]."', '".$_POST["Minimum"]."', '".$_POST["Boxes"]."', '".$_POST["Owner_Name"]."', '".$_POST["Status"]."', '".$_POST["Room"]."', '".$_POST["Section"]."', '".$_POST["Shelf"]."', '".$_POST["Level"]."', '".$_POST["Note"]."')";
if(mysqli_query($connect, $sql)){
echo 'Data Inserted';
}


$date = date('Y-m-d h:i a', time());
$log_date = date('Y-m-d h:i:s a', time());
$Item = $_POST["Item_Name"];
$query = "INSERT INTO `ITM_Logs`(`date`, `action`) VALUES ('$log_date','Added ($Item)')";
$result = mysqli_query($connect,$query);


?>
