@extends('layouts.frontend')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-9 mx-auto">
            <!-- Product List -->
            <div class="product">
                <h4 class="mb-4"><b>{{ $title }}</b></h4>

                @include('components.frontend.product_list')

                <br>

                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<!-- Add page-specific JavaScript here if needed -->
@endsection
