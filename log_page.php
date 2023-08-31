<?php include('header.php'); 
include("database_connect.php");
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
<?php
// HTML for table header

include('build_logs_starter.php');
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

// hold the database
$result = mysqli_query($connect,$query);

// check if the connection works
if(!$result){
    die("query Failed".mysqli_error($connection));
}

else{
    // Shelf is not empty
    if(mysqli_num_rows($result) > 0){

        //fetch each item       
        while($row = mysqli_fetch_assoc($result)){
            ?>
            <!-- Note: Putting the two actions first can reduce scrolling for mobile users. -->
            <tr>
                <!-- <td><a href="delete_item.php?serial_number=<?php echo $row['serial_number'] ?>&name= <?php echo $row['name'] ?>" class = "btn btn-danger">Delete</a> -->
                <td><?php echo $row['date'] ?></td>
                <td><?php echo $row['action'] ?></td>
            </tr> 
            <?php
            
        }
    }
    else{
        ?>
        <tr>
        <td colspan="2">No Record Found</td>
        </tr>
        <?php
    }
}    
echo "</tbody>";

echo "</table>"; 


?>
</div>