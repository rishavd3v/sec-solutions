<div class="d-none d-lg-block">
    <div class="row">
        @foreach($products as $r)
        <div class="col-sm-3 mb-3 d-none d-lg-block">
            <div class="card-product">
                <a href="{{ url('product/'.$r->id) }}" class="text-product">
                    <img src="{{ url_images('image', $r->image) }}" class="img-fluid w-100">
                </a>
                <div class="clearfix mb-3"></div>
                <h5 class="text-product">₹ {{ number_format($r->price) }},-</h5>
                <a href="{{ url('product/'.$r->id) }}" class="text-product">{{ $r->product_name }}</a>
                <div class="clearfix"></div>
            </div>  
        </div>  
        @endforeach
    </div>
</div>
<div class="d-lg-none">
    <div class="row">
        @foreach($products as $r)
        <div class="col-6 mb-3 d-lg-none">
            <div class="card-product">
                <a href="{{ url('product/'.$r->id) }}" class="text-product">
                    <img src="{{ url_images('image', $r->image) }}" class="img-fluid w-100">
                </a>
                <div class="clearfix mb-3"></div>
                <h5 class="text-product">₹ {{ number_format($r->price) }},-</h5>
                <a href="{{ url('product/'.$r->id) }}" class="text-product">{{ $r->product_name }}</a>
                <div class="clearfix"></div>
            </div>  
        </div>  
        @endforeach
    </div>  
</div>