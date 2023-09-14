

<?php 
// include("header.php"); 
// include("function/database_connect.php");
// date_default_timezone_set('America/Toronto'); 
// // include("Mobile-Detect/src/MobileDetect.php");
// include("function/check_mobile.php");
// // echo is_mobile();
// // error_reporting(E_ALL);
// // ini_set('display_errors', 1);
session_start();
$_SESSION["style"] = "Computer";

// $_SESSION["Log_close"] = "False";

if($isPhone || $isMobile) {
    echo "it is a phone";
    include("function/Mobile_Style.php");
    // do something with that device
} else {
    // process normally
    // echo "it is a computer";
    include("function/Mobile_Style.php");
    // include("function/Computer_Style.php");
}
?>
<!-- ########################  Search bar  ############################## style="width: 95%;padding: 50px;height:30px;" class="input-group mb-3" class="form-control" -->


<!-- Placeholder -->
<div id = "disp_data"></div>
<!-- Button trigger modal -->

<script>


function showPopup() {
    document.getElementById('overlay1').style.display = 'flex';
}

function processInput() {

    // return new Promise((resolve, reject) => {
    var userName = document.getElementById('person').value;
    var userNote = document.getElementById('note1').value;
    if (userName == "Not_Here" ){
        userName = document.getElementById('person1').value;
    }

    // You can process the input here or send it to a server-side script using AJAX
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "function/complete_log.php",false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("person="+userName+"&note="+userNote);

    // Close the pop-up
    document.getElementById('overlay1').style.display = 'none';

}

$(document).on('click', '#btn_close', function(){ 
    <?php 
        $_SESSION["Log_close"] = "True";
    ?>
    console.log("Hello");
    alert("The database won't be updated.");
    document.getElementById('overlay1').style.display = 'none';
    disp_data();

})

// ############################### Insert data ##########################
// If Add button is pressed
$(document).on('click', '#btn_add', function(){  

    // Gather Input
    var Item_Name = $('#Item_Name').text();  
    var Supplier = $('#Supplier').text();
    var Est_Quantity = $('#Est_Quantity').text(); 
    var Exact_Quantity = $('#Exact_Quantity').text(); 
    var Minimum = $('#Minimum').text();
    var Boxes = $('#Boxes').text(); 
    var Owner_Name = $('#Owner_Name').text(); 
    var Status = $('#Status').text(); 
    var Room = $('#Room').text(); 
    var Section = $('#Section').text(); 
    var Shelf = $('#Shelf').text(); 
    var Level = $('#Level').text(); 
    var Note = $('#Note').text(); 

    // Check for empty input
    check_list = [Item_Name,Status,Room,Section,Shelf,Level];
    var checked = false;
    check_list_string = ["Item Name","Status","Room","Section","Shelf","Level"];
    for (var i = 0; i < check_list.length; i++) {
        var field = check_list[i];

        if (isEmpty(field)) {
            alert(check_list_string[i] + " is empty. (please enter / for unused attributes.)");
            checked = false;
            break; 
        }
        checked = true;
    }

    if (isEmpty(Est_Quantity) && isEmpty(Exact_Quantity)){
        alert("Please enter the qunatity in Estimate or in Exact Quantity.");
    }

    
    if ((isEmpty(Est_Quantity) && isEmpty(Exact_Quantity))== false && checked == true){
        showPopup();
    // }
    // Ready to insert variable 
    $.ajax({  
        url:"function/insert.php",  
        method:"POST",  
        data:{
            Item_Name: Item_Name,
            Supplier: Supplier,
            Est_Quantity: Est_Quantity,
            Exact_Quantity: Exact_Quantity,
            Minimum: Minimum,
            Boxes: Boxes,
            Owner_Name: Owner_Name,
            Status: Status,
            Room: Room,
            Section: Section,
            Shelf: Shelf,
            Level: Level,
            Note: Note
        },  
        dataType:"text",  
        success:function(data){  
            // alert(data);  
            disp_data();  
        }  
    });
}
}); 

function isEmpty(value) {
        return value.trim() === '';
    }

// #####################  Display data ###########################

function disp_data(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "function/update.php",false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("Action=disp");
    document.getElementById("disp_data").innerHTML=xmlhttp.responseText;
}

disp_data()


// ######################### Update Data  #################################
function inner_edit(id,Column){

        replace_id = Column+id;
        txt_replace_id = "txt"+Column+id;
        var replace_input =document.getElementById(replace_id).innerHTML;
        document.getElementById(replace_id).innerHTML="<input type = 'text' value='"+replace_input+"' id ='"+txt_replace_id+"' style = 'width: 100%;' >";
        // size = '9'
}

function edit1(id){
    inner_edit(id,"Name");
    inner_edit(id,"Supplier");
    inner_edit(id,"Est_Quantity");
    inner_edit(id,"Exact_Quantity");
    inner_edit(id,"Minimum");
    inner_edit(id,"Boxes");
    inner_edit(id,"Owner_Name");
    inner_edit(id,"Status");
    inner_edit(id,"Room");
    inner_edit(id,"Section");
    inner_edit(id,"Shelf");
    inner_edit(id,"Level");
    inner_edit(id,"Note");

    updateid = "update"+id;
    document.getElementById(id).style.display= "none";
    document.getElementById(updateid).style.display= "block";
}

function update1(id)
{
    var Name_id = "txtName"+id;
    var Name = document.getElementById(Name_id).value;

    var Supplier_id = "txtSupplier"+id;
    var Supplier = document.getElementById(Supplier_id).value;

    var Est_Quantity_id = "txtEst_Quantity"+id;
    var Est_Quantity = document.getElementById(Est_Quantity_id).value;

    var Exact_Quantity_id = "txtExact_Quantity"+id;
    var Exact_Quantity = document.getElementById(Exact_Quantity_id).value;

    var Minimum_id = "txtMinimum"+id;
    var Minimum = document.getElementById(Minimum_id).value;

    var Boxes_id = "txtBoxes"+id;
    var Boxes = document.getElementById(Boxes_id).value;

    var Owner_Name_id = "txtOwner_Name"+id;
    var Owner_Name = document.getElementById(Owner_Name_id).value;

    var Status_id = "txtStatus"+id;
    var Status = document.getElementById(Status_id).value;

    var Room_id = "txtRoom"+id;
    var Room = document.getElementById(Room_id).value;

    var Section_id = "txtSection"+id;
    var Section = document.getElementById(Section_id).value;

    var Shelf_id = "txtShelf"+id;
    var Shelf = document.getElementById(Shelf_id).value;

    var Level_id = "txtLevel"+id;
    var Level = document.getElementById(Level_id).value;

    var Note_id = "txtNote"+id;
    var Note =document.getElementById(Note_id).value;    
             
          
    update_data(id, Name, Supplier, Est_Quantity, Exact_Quantity, Minimum, Boxes, Owner_Name, Status, Room, Section, Shelf, Level, Note );

    document.getElementById("Name"+id).innerHTML= Name;

    document.getElementById("Supplier"+id).innerHTML= Supplier;

    document.getElementById("Est_Quantity"+id).innerHTML= Est_Quantity;

    document.getElementById("Exact_Quantity"+id).innerHTML= Exact_Quantity;

    document.getElementById("Minimum"+id).innerHTML= Minimum;

    document.getElementById("Boxes"+id).innerHTML= Boxes;

    document.getElementById("Owner_Name"+id).innerHTML= Owner_Name;

    document.getElementById("Status"+id).innerHTML= Status;

    document.getElementById("Room"+id).innerHTML= Room;

    document.getElementById("Section"+id).innerHTML= Section;

    document.getElementById("Shelf"+id).innerHTML= Shelf;

    document.getElementById("Level"+id).innerHTML = Level;

    document.getElementById("Note"+id).innerHTML = Note;
}

function update_data(id, Name, Supplier, Est_Quantity, Exact_Quantity, Minimum, Boxes, Owner_Name, Status, Room, Section, Shelf, Level, Note ){
    
    // problem with print initial variable print_r($_SESSION);
    // <sphp $_SESSION["Log_close"] = "False"; ?>
    
    showPopup();
    // <php session_commit(); ?>
    // var log_close = '<php echo $_SESSION["Log_close"]; ?>';
    // console.log(og_close);
    // if (log_close == 'False'){
    // console.log('<php echo $_SESSION["Log_close"]; ?>');
    // xmlhttp = new XMLHttpRequest();
    // xmlhttp.open("POST", "function/update.php", false);
    // xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    // variable = "id="+id+"&Name="+Name+"&Supplier="+Supplier+"&Est_Quantity="+Est_Quantity+"&Exact_Quantity="+Exact_Quantity+"&Minimum="+Minimum+"&Boxes="+Boxes+"&Owner_Name="+Owner_Name+"&Status="+Status+"&Room="+Room+"&Section="+Section+"&Shelf="+Shelf+"&Level="+Level+"&Note="+Note+"&Action=Update";
    // xmlhttp.send(variable);
    // disp_data();
    // } 
    // else{
    //     console.log('<php echo $_SESSION["Log_close"]; ?>');
    //     <php $_SESSION["Log_close"] = "False"; ?>
    //     disp_data();
    // }
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "function/update.php", false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    variable = "id="+id+"&Name="+Name+"&Supplier="+Supplier+"&Est_Quantity="+Est_Quantity+"&Exact_Quantity="+Exact_Quantity+"&Minimum="+Minimum+"&Boxes="+Boxes+"&Owner_Name="+Owner_Name+"&Status="+Status+"&Room="+Room+"&Section="+Section+"&Shelf="+Shelf+"&Level="+Level+"&Note="+Note+"&Action=Update";
    xmlhttp.send(variable);
    document.getElementById("disp_data").innerHTML=xmlhttp.responseText;
    disp_data();
}

// #######################  Delete data ############################
function delete1(id, name){
    showPopup();
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "function/update.php", false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    variable = "id="+id+"&name="+name+"&Action=Delete";
    xmlhttp.send(variable);
    disp_data();
}

</script>
    
</body>  
</html>  
 































