<form action="function/Mobile_Insert.php" method = "post">

<!-- Button trigger modal -->
<div style="padding-left: 40px;">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >
Add Item
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <br>
      

      <label for="Item_Name">1. Name:</label><br>
            <!-- <input type="text" name = "item_name" class = "form-control" required> -->
            <input type="text" name = "Item_Name" list="brow" >
            <datalist id="brow" name = "Item_Name" required>
              <option name = "Item_Name" value="Panel">
              <option name = "Item_Name" value="R">
              <option name = "Item_Name" value="Chrome">
              <option name = "Item_Name" value="Opera">
              <option name = "Item_Name" value="Safari">
            </datalist>  
            <br>
            <label for="Supplier">2. Supplier: </label>
            <input type="text" name = "Supplier" class = "form-control" value = ""  >
     
            <br>
            <label for="Est_Quantity">3. Est_Quantity: </label>
            <input type="text" name = "Est_Quantity" class = "form-control" required >
            <br>
            <label for="Exact_Quantity">3. Exact_Quantity: </label>
            <input type="text" name = "Exact_Quantity" class = "form-control" value = "" >
            <br>
            <label for="Minimum">4.Minimum:</label>
            <input type="text" name = "Minimum" class = "form-control" value = "" >
     
            <br>
            <label for="Boxes">3.Boxes: </label>
            <input type="text" name = "Boxes" class = "form-control" value = "" >
            <br>
            <label for="Owner_Name">3. Owner_Name:</label>
            <input type="text" name = "Owner_Name" class = "form-control" value = "" >
            <br>
            <label for="Status">3.Status:</label>
            <br>
            <input type="radio" name="Status" value="AVAILABLE" required style="margin-left: 10px; margin-right: 5px">AVAILABLE  
            <input type="radio" name="Status" value="MISSING" style="margin-left: 10px; margin-right: 5px">MISSING
            <input type="radio" name="Status" value="ASSIGNED" style="margin-left: 10px; margin-right: 5px">ASSIGNED 
            <br>
            <label for="Room">4.Room:</label>
            <input type="text" name = "Room" class = "form-control" value = "162" required>
            <br>
            <br>
            <label for="Section">5.Section:</label>
            <input type="text" name = "Section" class = "form-control" value = "">
            <br>
            <label for="Shelf">5. Shelf:</label><br>    
            <input type="radio" name="Shelf" value="A" style="margin-left: 10px; margin-right: 5px">A  
            <input type="radio" name="Shelf" value="B" style="margin-left: 10px; margin-right: 5px">B  
            <input type="radio" name="Shelf" value="C" style="margin-left: 10px; margin-right: 5px">C  
            <input type="radio" name="Shelf" value="D" style="margin-left: 10px; margin-right: 5px">D  
            <input type="radio" name="Shelf" value="E" style="margin-left: 10px; margin-right: 5px">E  
            <input type="radio" name="Shelf" value="F" style="margin-left: 10px; margin-right: 5px">F  
            <br>
            <label for="Level">5. Level:</label><br>
            <input type="radio" name="Level" value="1" style="margin-left: 10px; margin-right: 5px">1 (Top)
            <input type="radio" name="Level" value="2" style="margin-left: 10px; margin-right: 5px">2
            <input type="radio" name="Level" value="3" style="margin-left: 10px; margin-right: 5px">3
            <input type="radio" name="Level" value="4" style="margin-left: 10px; margin-right: 5px">4
            <input type="radio" name="Level" value="5" style="margin-left: 10px; margin-right: 5px">5
            <br>
            <label for="Note">10.Note:</label>
            <input type="text" name = "Note" class = "form-control" value = "" >
            <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" name = "add_item" value = "Add" >
      </div>
    </div>
  </div>
</div>
</form>