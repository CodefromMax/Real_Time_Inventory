<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>    
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Inventory Database</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

        <!-- <link rel='stylesheet' type='text/css' href='style.css'/> -->
        <link type="text/css" rel="stylesheet" href="style.css" media = "screen"/>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"> 
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>  
    <body>
        <a href= "index.php">
            <h1 style = "font-size:15;
                text-align: center;
                background-color: #0c5fa8;
                color: #fff;
                padding: 5px;
                font-weight: 500;
                width:100%;" 
                >ITM Inventory Database</h1>
        </a>
    
    

<?php 
// include("header.php"); 
include("database_connect.php");
date_default_timezone_set('America/Toronto'); 
// include("Mobile-Detect/src/MobileDetect.php");
// include("function/check_mobile.php");
// echo is_mobile();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();
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
?>

<div class="overlay1" id="overlay1">
    <div class="popup">
        <label for="person">User Name: </label><br>
        <select name="person" id="person">
            <option value="A" <?php if ($row["person"] == 'A') echo 'selected'; ?>>A</option>
            <option value="B" <?php if ($row["person"] == 'B') echo 'selected'; ?>>B212122112</option>
            <option value="C" <?php if ($row["person"] == 'C123') echo 'selected'; ?>>C</option>
            <option value="D" <?php if ($row["person"] == 'D123') echo 'selected'; ?>>D</option>
            <option value="E" <?php if ($row["person"] == 'E123') echo 'selected'; ?>>E</option>
            <option value="F" <?php if ($row["person"] == 'F123') echo 'selected'; ?>>F</option>
            <option value="Not_Here">Not Here</option>
        </select>
        <br>
        <br>    
        <label for="person1">If your name is not in the database: </label>
        <br>
        <input type="text" id="person1"  name = "person1" palceholder = "Please enter your name." >
        <br>
        <br>
        <label for="note1">Note: </label><br>
        <input type="text" id="note1"  name = "note1" >
        <br>
        <br>
        <button onclick="processInput()" class="btn btn-primary btn-block" id = "process_input">Submit</button>
        <!-- <button  class="btn btn-danger btn-block" id = "btn_close" >Cancel</button>  calss = "form-control"-->
    </div>
</div>
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