<div class="col-10 mb-4 mb-md-0 col-md-3 related-item">
    <a href="/product/{{ $product->slug }}">
        <div class="image-wrapper">
            
            @if (isset($product->featuredImage))
                <div class="square image" style="background-image: url('/storage/{{ $product->featuredImage->path }}')"></div>
            @else    
                <div class="square image"></div>
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
</div>