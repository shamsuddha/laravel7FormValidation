{{--
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif--}}


<form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
 @csrf
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control" id="title">
    </div>
    <br>
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <div class="form-group">
        <label for="pwd">Body:</label>
     <textarea name="body" rows="20" cols="80"></textarea>
    </div><br><br>

    <input type="checkbox" id="vehicle1" name="vehicle[]" value="Bike">
    <label for="vehicle1"> I have a bike</label><br>
    <input type="checkbox" id="vehicle2" name="vehicle[]" value="Car">
    <label for="vehicle2"> I have a car</label><br>
    <input type="checkbox" id="vehicle3" name="vehicle[]" value="Boat">
    <label for="vehicle3"> I have a boat</label><br><br>

    Select image to upload:
    <input type="file" name="image" id="fileToUpload">
    <br/>

    <button type="submit" class="btn btn-default">Submit</button>
</form>
