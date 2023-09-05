<?php

include("database_connect.php");
session_start();
if(isset($_GET['recipient'])){
   $Recipient = $_GET['recipient'];
}

else{
   echo "Please contact Admin team for support.";
}



$sql = "SELECT * FROM `ITM_Inventory` ORDER BY Item_ID ASC";

$output = '';  
//  $sql = "SELECT * FROM ITM_inventory ORDER BY Item_ID ASC";  

//Session variable is a temporary variable used to store PHP variable across different PHP pages
//It will disappear upon closing the page
//Session_start is used to start a new or sync with a existing session
//Here, sql is the variable we want to get from the database page
//sql variable from the database page shows the current query
//Which will be used to gather data from MySQL database and convert it to CSV


//CSV

$output = fopen("C:\website\Compliance\inventory_applcation\ITM2\downloaded_database\ITM_inventory_database.csv", "w");  
fputcsv($output, array('Item_ID', 'Item_Name', 'Supplier', 'Est_Quantity','Exact_Quantity', 'Minimum', 'Boxes', 'Owner_Name', 'Status',
'Room', 'Section', 'Shelf', 'Level', 'Note'));  
$result = mysqli_query($connect,$sql);



//Write each row into csv
while($row = mysqli_fetch_assoc($result))  
{
   fputcsv($output, $row);  
}  

fclose($output);  


$result1 = mysqli_query($connect,"SELECT * FROM `ITM_Inventory` WHERE (CAST(`Est_Quantity` AS SIGNED) < CAST(`Minimum` AS SIGNED)) ORDER BY `Item_ID` ASC ");
$rows1 = mysqli_num_rows($result1);

if ($rows1>0){
   $output = fopen("C:\website\Compliance\inventory_applcation\ITM2\downloaded_database\ITM_below_minimum_list.csv", "w");  
   fputcsv($output, array('Item_ID', 'Item_Name', 'Supplier', 'Est_Quantity','Exact_Quantity', 'Minimum', 'Boxes', 'Owner_Name', 'Status',
   'Room', 'Section', 'Shelf', 'Level', 'Note'));  

   while($row = mysqli_fetch_assoc($result1))  
   {  
      fputcsv($output, $row);  
   }  

   fclose($output);  

}

$mailto = $Recipient;
//Email subject
$subject = "Monthly ITM Inventory Updates";
//Read the content of the file
$filename = 'ITM_inventory_database.csv';
// \downloaded_database\
chdir("C:\website\Compliance\inventory_applcation\ITM2\downloaded_database");
$file = 'ITM_inventory_database.csv';
$content = file_get_contents( $file);
$content = chunk_split(base64_encode($content));
$uid = md5(uniqid(time()));
$file_name = basename($file);

if ($rows1>0){
   $message = "Dear ITM Team, \r\n\r\n Please find attached the updated inventory database and the reordering list. \r\n\r\n Online Database link: https://ytfvpnmna02.twnet.toronto.ca/Compliance/Inventory_Applcation/ITM2/index.php\r\n\r\n Thank you.";
}
else{
   $message = "Dear ITM Team, \r\n\r\n Please find attached the updated inventory database. (No reordering is needed.) \r\n \r\n Online Database link: https://ytfvpnmna02.twnet.toronto.ca/Compliance/Inventory_Applcation/ITM2/index.php\r\n \r\n Thank you.";
}

// header
$header = "From: Admin <TWPCS@toronto.ca>"."\r\n";
// "From: ".$from_name." <".$from_mail.">\r\n";
// $header .= "Reply-To: ".$replyto."\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

// message & attachment
$nmessage = "--".$uid."\r\n";
$nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$nmessage .= $message."\r\n\r\n";
$nmessage .= "--".$uid."\r\n";
$nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
$nmessage .= "Content-Transfer-Encoding: base64\r\n";
$nmessage .= "Content-Disposition: attachment; filename=\"".$file_name."\"\r\n\r\n";
$nmessage .= $content."\r\n\r\n";

if ($rows1>0){

$nmessage .= "--".$uid."\r\n";

$filename2 = 'ITM_below_minimum_list.csv';

$fileContent2 = file_get_contents($filename2);
$nmessage .= "Content-Type: application/octet-stream; name=\"" . basename($filename2) . "\"" . "\r\n";
$nmessage .= "Content-Transfer-Encoding: base64" . "\r\n";
$nmessage .= "Content-Disposition: attachment" . "\r\n";
$nmessage .= "\r\n" . chunk_split(base64_encode($fileContent2)) . "\r\n";
// $message .= "--" . $separator . "--";
$nmessage .= "--".$uid."--";

}

else{
   $nmessage .= "--".$uid."--";
}

if (mail($mailto, $subject, $nmessage, $header)) {
   
   echo ' <a href= "../index.php">
   <h1 id = "main_title">Go back to ITM Inventory Database</h1>
</a>';
   
   echo "<h1>Email sent successfully.</h1>";}
   else{
      echo "Unable to send the email.";}


 ?>