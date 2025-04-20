<div class="modal-header">
    <h5 class="modal-title">Edit Product</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="post" action="{{ route('admin.update_product') }}" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="">Category</label>
            <select class="form-select" name="id_category" required>
                @foreach($categories as $r)
                <option value="{{ $r->id }}" {{ $edit->id_category == $r->id ? 'selected' : ''}}>{{ $r->category_name }}</option>
                @endforeach
            </select>
            @error("id_category")
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="">Product Name</label>
            <input type="text" class="form-control @error("product_name") is-invalid @enderror" value="{{$edit->product_name}}" name="product_name" id="product_name" placeholder="">
        </div>
        
        <div class="form-group mt-3">
            <label for="">Description</label>
            <textarea class="form-control @error("description") is-invalid @enderror" rows="8" name="description" id="description" placeholder="">{{$edit->description}}</textarea>
        </div>
        <div class="form-group mt-3">
            <label for="">Selling Price</label>
            <input type="number" class="form-control @error("selling_price") is-invalid @enderror" value="{{$edit->selling_price}}" name="selling_price" id="selling_price" placeholder="">
        </div>
        <div class="form-group mt-3">
            <label for="">Image <small class="text-danger ms-1">* Optional</small></label>
            <input type="file" class="form-control @error("image") is-invalid @enderror" value="{{old("image")}}" 
                 name="image" id="image" placeholder="">
            @error("image")
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <a href="{{url_images('image', $edit->image)}}" target="_blank">
                <img src="{{url_images('image', $edit->image)}}" class="img-fluid mt-3" style="width:80px;">
            </a>
        </div>
        <input type="hidden" value="{{$edit->id}}" name="id">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
