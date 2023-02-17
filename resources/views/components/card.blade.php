<div class="col-lg-3 col-md-3 col-sm-4 col-6">
    <div class="product-wrap mb-35" data-aos="fade-up">
        <div class="product-img img-zoom mb-25">
            <a href="{{route('product', $product['id'])}}">
                <img src="{{asset('storage/'.$product['image'])}}" alt="{{$product['name']}}">
            </a>
            {{-- <div class="product-badge badge-top badge-right badge-pink">
                <span>-10%</span>
            </div> --}}
            {{-- <div class="product-action-wrap">
                <button class="product-action-btn-1" title="Wishlist"><i class="pe-7s-like"></i></button>
                <button class="product-action-btn-1" title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="pe-7s-look"></i>
                </button>
            </div>
            <div class="product-action-2-wrap">
                <button class="product-action-btn-2" title="Add To Cart"><i class="pe-7s-cart"></i> Add to cart</button>
            </div> --}}
        </div>
        <div class="product-content">
            <h3><a href={{route('product', $product['id'])}}>{{$product['name']}}</a></h3>
            <div class="product-price">
                <span class="old-price">$ {{ceil($product['price']*1.25)}}</span>
                <span class="new-price">$ {{$product['price']}}</span>
            </div>
        </div>
    </div>
</div>
