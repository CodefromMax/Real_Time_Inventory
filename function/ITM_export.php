<?php  
session_start(); 
include("database_connect.php");

if($_SESSION["search"] != ""){
    // Note: using the SELECT query style `table` #Order by Shelf is used in downloading the data
    $val = $_SESSION["search"];
    $sql = "SELECT * FROM `ITM_Inventory` WHERE CONCAT(`Item_Name`,`Supplier`,`Status`) LIKE '%$val%' ORDER BY `Item_ID` ASC ";
    
}

else{
    $sql = "SELECT * FROM `ITM_Inventory` ORDER BY Item_ID DESC";
}

if($_SESSION["notify"] != ""){
    // get all the items that (Est_Quantity < Minimum) cast as INTEGER is a function to change string to integer
    $sql = "SELECT * FROM `ITM_Inventory` WHERE (CAST(`Est_Quantity` AS SIGNED) < CAST(`Minimum` AS SIGNED)) ORDER BY `Item_ID` ASC ";
}

$output = '';  
//  $sql = "SELECT * FROM ITM_inventory ORDER BY Item_ID ASC";  

//Session variable is a temporary variable used to store PHP variable across different PHP pages
//It will disappear upon closing the page
//Session_start is used to start a new or sync with a existing session
//Here, sql is the variable we want to get from the database page
//sql variable from the database page shows the current query
//Which will be used to gather data from MySQL database and convert it to CSV


//CSV
header('Content-Type: text/csv; charset=utf-8');  
header('Content-Disposition: attachment; filename=inventory_database.csv');  
$output = fopen("php://output", "w");  
fputcsv($output, array('Item_ID', 'Item_Name', 'Supplier', 'Est_Quantity','Exact_Quantity', 'Minimum', 'Boxes', 'Owner_Name', 'Status',
'Room', 'Section', 'Shelf', 'Level', 'Note'));  
$result = mysqli_query($connect,$sql);

//Write each row into csv
while($row = mysqli_fetch_assoc($result))  
{  
    fputcsv($output, $row);  
}  

fclose($output);  


//Debug Note: 
//If exporting is not working:
//Comment the //CSV section

// Uncomment 
// echo updated_query; in the second and third if statement and 
// the function below.

// Try to click the export from different pages (ALL,DNS)
// Check the query
// If the query is ok

// Try the function below and the useful links 

//This function is used to understand regex in PHP
// function useRegex($input) {
//     // $regex = '/`shelf` = \'[A-F]\'/i';
//     $regex = '/WHERE `shelf` = \'F\'/i';
//     // preg_match($regex, $input)
//     return preg_match($regex, $input);
// }

// Useful links:
// https://www.php.net/manual/en/function.str-contains.php
// https://regex-generator.olafneumann.org/?sampleText=WHERE%20%60shelf%60%20%3D%20%27F%27&flags=i&selection=12%7CCharacter,14%7CCharacter,16%7CCharacter,18%7CCharacter

 ?>  
