<div class="col-3 related-item">
    <a href="/product/{{ $product->slug }}">
        <div class="image-wrapper">
            <div class="square image" style="background-image: url('/storage/{{ $product->featuredImage->path }}')"></div>
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