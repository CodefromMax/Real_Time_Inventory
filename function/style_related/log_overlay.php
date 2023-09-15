<!-- <button onclick="showPopup()">Open Pop-up</button> -->
<div class="overlay1" id="overlay1">
    <div class="popup">
        <label for="person">User Name: </label><br>
        <select name="person" id="person">
            <option value="Aly Mawani" <?php if ($row["person"] == 'Aly Mawani') echo 'selected'; ?>>Aly Mawani</option>
            <option value="Kyle Phillips" <?php if ($row["person"] == 'Kyle Phillips') echo 'selected'; ?>>Kyle Phillips</option>
            <option value="Michael Singh" <?php if ($row["person"] == 'Michael Singh') echo 'selected'; ?>>Michael Singh</option>
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