@extends('layouts.frontend')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-9 mx-auto">
            <!-- Product -->
            <div class="product">
                <h4 class="mb-4"><b>{{ $title }}</b></h4>
                <div class="row">
                    <div class="col-sm-4">
                        <img src="{{ url_images('image', $product->image) }}" class="img-fluid w-100 mb-3" alt="Product Image">
                    </div>
                    <div class="col-sm-8 product-details">
                        <div class="row mt-3">
                            <div class="col-sm-4"><b>Category</b></div>
                            <div class="col-sm-8">
                                <a class="product-link" href="{{ url('category/' . $product->category_id) }}">
                                    {{ $product->category_name }}
                                </a>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4"><b>Product Name</b></div>
                            <div class="col-sm-8">{{ $product->product_name }}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4"><b>Price</b></div>
                            <div class="col-sm-8 text-success">
                                <h4><b>₹{{ number_format($product->price) }}</b></h4>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4"><b>Description</b></div>
                            <div class="col-sm-8">{{ $product->description }}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8">
                                <a class="btn btn-success btn-md"
                                   href="https://api.whatsapp.com/send?phone={{ $store_profile->phone }}&text=Hello+Admin,+I+would+like+to+order+this+product:+{{ url('product/' . $product->id) }}"
                                   target="_blank" role="button">
                                    <i class="fab fa-whatsapp"></i> Order Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product -->
        </div>
    </div>
</div>
@endsection

@section('javascript')
<!-- Add custom JS here if needed -->
@endsection
