<x-app-layout>

    <div class="product-page pb-5">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-11 col-lg-9">

                    <div class="row">
                        
                        <div class="col-12 col-md-6 mb-5 mb-md-0">
                            <div class="product-images">
                                <div class="main">
                                    <div class="image">
                                        @if (isset($product->featuredImage))
                                            <img id="product-featured-image"  src="/storage/{{ $product->featuredImage->path }}">
                                        @else
                                            <img id="product-featured-image">
                                        @endif
                                    </div>
                                </div>
                                <div class="sub">
                                    <!-- Swiper -->
                                    <div class="swiper-container product-image-swiper">
                                        <div class="swiper-wrapper">
                                            
                                            <div class="swiper-slide">
                                                <div class="slide-content">
                                                    @if (isset($product->featuredImage))
                                                        <img src="/storage/{{ $product->featuredImage->path }}" alt="{{ $product->featuredImage->name }}" class="product-swiper-image">
                                                    @else
                                                        <img class="product-swiper-image">
                                                    @endif
                                                </div>
                                            </div>

                                            @isset($product->images_models)
                                                @foreach ($product->images_models as $image)
                                                    
                                                    <div class="swiper-slide">
                                                        <div class="slide-content">
                                                            <img src="/storage/{{ $image->path }}" alt="{{ $image->name }}" class="product-swiper-image">
                                                        </div>
                                                    </div>
                                                    
                                                @endforeach
                                            @endisset

                                        </div>

                                        <!-- If we need navigation buttons -->
                                    </div>

                                    <div class="product-swiper-prev">
                                        <i class="fas fa-caret-left"></i>
                                    </div>
                                    <div class="product-swiper-next">
                                        <i class="fas fa-caret-right"></i>
                                    </div>
                                </div>
                                <div class="add-to-cart-wrapper my-3">
                                    <p>
                                        Adja hozzá az ajánlatkéréshez!
                                    </p>
                                    <div class="cart-action-add">
                                        <input type="number" min="1" max="200" value="1" > db
                                        
                                        <div class="btn btn-primary btn-sm add-to-cart-btn ms-2" data-name="{{ $product->name }}" data-id="{{ $product->id }}">
                                            Hozzáad
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="product-info">
                                <div class="category-img mb-3">
                                    
                                    @isset($product->categoryImage)
                                        <img src="/storage/{{ $product->categoryImage->path }}" alt="{{ $product->categoryImage->name }}">
                                    @endisset
                    
                                </div>

                                <div class="name">
                                    <h1>
                                        {{ $product->name }}
                                    </h1>
                                </div>

                                <div class="description">
                                    <p>
                                        {{ $product->description }}
                                    </p>
                                </div>
                                <div class="attributes ps-4">
                                    <table class="table table-sm table-borderless">
                                        <tbody>
                                            @foreach ($product->attributes as $attr)
                                                <tr class="attribute mb-2">
                                                    <td class="key">&#8226; {{ $attr->key }}</td>
                                                    <td class="value">{{ $attr->value }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>


</x-app-layout>
