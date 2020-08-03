<div class="form-group">
    <label for="projectImage">image url:</label>
    <input type="text" class="form-control" id="projectImage" name="projectImage"
           placeholder="http://building.png">
</div>
<h2>What type of building is your project ?</h2>
<form  action="{{ route('newBuilding3') }}" method="post">
    <div class="form-group">
        <label for="type">Please select an option:</label>
        <select name="type" id="type">
            <option value="detached house">Detached house</option>
            <option value="apartment">Apartment</option>
            <option value="terraced house">Terraced house</option>
            <option value="multiple houses">Multiple houses</option>
            <option value="commercial building">Commercial building</option>
        </select>
    </div>
</form>
<br>
