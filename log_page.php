<?php include('header.php'); 
include("function/database_connect.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!-- Search bar -->
<form action="" method="GET">
    <div id = "searchbar" class="input-group mb-3" style="width: 95%;padding: 50px;">
        <input type="text" name="search_logs" value="<?php if(isset($_GET['search_logs'])){echo $_GET['search_logs']; } ?>" class="form-control" placeholder="Search Logs">
        <button type="submit" class="btn btn-primary btn-block">Search</button>
        <!-- Note: No requirement (required) for filling in the bar: easy to get all item. -->
    </div>
</form>

<div>

<!-- Title -->
<h2 style="width:95%;" align = "center"> Logs </h2>

<!-- Table -->
</div>
    <table class = "table table-hover table-bordered table-striped" style="width:95%;" align = "center">   
        <thead>
            <tr> 
                <!-- Note: Desgin choice: Logs cannot be removed. -->
                <!-- <th>Delete</th> -->
                <th>Date</th>
                <th>Person</th>
                <th>Action</th>
                <th>Note</th>
            </tr> 
        </thead>
    <tbody>
        
<?php
// HTML for table header
if(!isset($_GET['search_logs'])){
    // Note: using the SELECT query style `table` 
    $query = "SELECT * FROM `ITM_Logs`";
}

// Search bar used: filter based on query
else{
    // echo $_GET['search_logs'];
    $val = $_GET['search_logs'];
    $query = "SELECT * FROM `ITM_Logs` WHERE CONCAT(`date`,`action`) LIKE '%$val%' ";
}

$result = mysqli_query($connect,$query);

// check if the connection works
if(!$result){
    die("query Failed".mysqli_error($connect));
}

else{
    // Shelf is not empty
    if(mysqli_num_rows($result) > 0){

        //fetch each item       
        while($row = mysqli_fetch_assoc($result)){
            ?>
            <!-- Note: Putting the two actions first can reduce scrolling for mobile users. -->
            <tr>
                <!-- <td><a href="delete_item.php?serial_number=<php echo $row['serial_number'] ?>&name= <php echo $row['name'] ?>" class = "btn btn-danger">Delete</a> -->
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['person']; ?></td>
                <td><?php echo $row['action']; ?></td>
                <td><?php echo $row['note']; ?></td>
            </tr> 
            <?php
            
        }
    }
    else{
        ?>
        <tr>
        <td colspan="4">No Record Found</td>
        </tr>
        <?php
    }
}    
echo "</tbody>";

echo "</table>"; 


?>
</div>