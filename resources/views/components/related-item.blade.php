<div class="col-10 mb-4 mb-md-5 col-md-4 related-item position-relative">
    <a href="/product/{{ $product->slug }}">
        <div class="image-wrapper">
            
            @if (isset($product->featuredImage))
                <div class="square image lazy" data-bg-multi="url('/storage/{{ $product->featuredImage->path }}')"></div>
            @else    
                <div class="square image lazy" data-bg-multi="url('/storage/images/default-product.png')"></div>
            @endif

            <div class="blue-bg"></div>
        </div>

        <div class="name">
            <h1>
                {{ $product->name }}
            </h1>
        </div>
        <div class="read-more">
            <span>Részletek <i class="fas fa-angle-double-right"></i></span>
        </div>
    </a>
    @if (!$product->available)
        <a href="/product/{{ $product->slug }}" class="product-not-available">
            <div class="text fs-5 fw-bold">
                Beszerzés alatt!
            </div>
        </a>
    @endif
</div>