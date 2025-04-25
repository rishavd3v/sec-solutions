@extends('layouts.app')

@section('content')
<div class="container">
    {{ alertbs_form($errors) }}
    
    <!-- Add Product Button -->
    <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#modalAddProduct">
        <i class="fas fa-plus mr-1"></i> Add Product
    </button>

    <div class="card card-rounded mt-2">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title pt-2"> <i class="fas fa-database me-1"></i> Product Data</h5>
        </div>

        <div class="card-body">
            <!-- Search -->
            <div class="row">
                <div class="col-sm-4 ms-auto">
                    <form method="get" action="">
                        <div class="input-group mb-3">
                            <input type="text" name="search" id="search" value="{{ $request->get('search') }}" class="form-control" placeholder="Search Product">
                            @if($request->get('search'))
                                <a href="{{ route('admin.product') }}" class="input-group-text btn btn-success btn-md">
                                    <i class="fas fa-sync pr-2"></i>Refresh
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Product Table -->
            <div class="table-responsive mt-1">
                <table class="table table-striped table-bordered" id="example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse($products as $item)
                            <tr>
                                <td>{{ $no }}</td>
                                <td><img src="{{ url_images('image', $item->image) }}" class="img-fluid" style="width:80px;"></td>
                                <td>{{ $item->category_name }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>₹ {{ number_format($item->price) }},-</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-success btn-sm edit-btn" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ url("admin/product/delete/$item->id") }}" class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?');" title="Delete">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                            @php $no++; @endphp
                        @empty
                            <tr>
                                <td colspan="7">No Data Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <br>
            {{ $products->links() }}
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="modalAddProduct" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" action="{{ route('admin.create_product') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-select" name="category_id" required>
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                                @endforeach
                            </select>
                            @error("category_id") <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>Product Name</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" required>
                            @error("product_name") <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" required>{{ old('description') }}</textarea>
                            @error("description") <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>
                            @error("price") <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" required>
                            @error("image") <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="modalEditProduct" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="edit-content">
                <!-- Content loaded via AJAX -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $('#example1 tbody').on('click', '.edit-btn', function() {
        const id = $(this).data('id');
        $('#modalEditProduct').modal('show');
        $.ajax({
            url: '{{ route("admin.edit_product") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id
            },
            timeout: 60000,
            dataType: 'html',
            success: function(html) {
                $('#edit-content').html(html);
            }
        });
    });
</script>
@endsection