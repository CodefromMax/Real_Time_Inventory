<?php 
include("header.php"); 
include("function/database_connect.php");
date_default_timezone_set('America/Toronto'); 
// session_start();
?>

<div>
<form action="" method="GET">
    <div id = "searchbar" class="form-group"  align = "center" style="width: 100%;height:50px;">
        <input type="text" name="search"  style="width:50%;height:85%; text-align:center; border: 1px solid #555;" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-group" placeholder="Search Inventory" >
        <button type="submit" class="btn btn-primary btn-block" id = "btn_search" >Search</button>
        <!-- Note: No requirement (required) for filling in the bar: easy to get all item. -->
    </div>
</form>
</div>

<?php
// Get the last user from Logs. (Use it as a default person for the current action)
$sql = "SELECT * FROM `ITM_Logs` WHERE `id` = (SELECT MAX(`id`) FROM ITM_Logs)";
$result = mysqli_query($connect, $sql);  
$row = mysqli_fetch_array($result);
// echo $row["person"];
include("function/style_related/log_overlay.php");

// include("log_overlay.php")
?>

<!-- ########################  Logs  ############################## -->
<div id = "logs" align="center" >
    <a href = "log_page.php">
        <button style = "background-color: transparent; font-size: 25px;border: none; text-decoration:underline"> Logs </button>
    </a>
</div>

<!-- ########################  Check Minimum button  ############################## -->
<div id="notify" style="display: flex; justify-content: center; align-items: center; height: 10vh;">
    <form action="" method="GET" style="text-align: center;">
        <input type="hidden" name="notify" value="True">
        <button type="submit" class="btn btn-primary">Check Below Minimum Items</button>
    </form>
</div>

<?php

$_SESSION["style"] = "Mobile";

// Store variable
$_SESSION["search"] = "";

if(isset($_GET['search'])){
    $_SESSION["search"] = $_GET['search'];
}

$_SESSION["notify"]="";
if(isset($_GET['notify'])){
    $_SESSION["notify"] = $_GET['notify'];
}
 ?>

<!-- <?php
// Store variable
// $_SESSION["search"] = $_GET['search']; 
// $_SESSION["notify"] = $_GET['notify']; ?> -->

<!-- ########################  Create CSV  ############################## -->

<!-- <div id = "export">
    <form method="post" action="function/ITM_export.php" style = "text-align:center;height: 7vh;">  
        <input type="submit" name="export" value="Export Inventory Database" class="btn btn-success" />  
    </form>
</div>

<form action="function/send_email.php" method="GET" enctype="multipart/form-data"  style = "text-align:center; ">
        <label for="recipient">Recipient Email:</label>
        <input type="email" name="recipient" value = "zhaoqi.wang@toronto.ca" required>
        <button type="submit" name="submit">Send</button>
</form> -->

<!-- <?php
// Store variable
if(isset($_GET['recipient'])){
$_SESSION["recipient"] = $_GET['recipient']; }

?> -->

<?php include("add_item_form.php"); ?>