<div class="form-group">
    <label for="projectImage">image url:</label>
    <input type="text" class="form-control" id="projectImage" name="projectImage"
           placeholder="http://building.png">
</div>
<h2>What are you going to do?</h2>
<form  action="{{ route('newBuilding2') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="status">Please select an option:</label>
        <select name="status" id="status">
            <option value="renovation">Renovation</option>
            <option value="demolition">Demolition</option>
            <option value="new Build">New Build</option>
            <option value="nothing">Nothing</option>
        </select>
    </div>
</form>
<br>
