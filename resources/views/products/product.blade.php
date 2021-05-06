<x-app-layout>

    <div class="product-page">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-8">

                    <div class="row">
                        
                        <div class="col-6">
                            <div class="product-images">
                                <div class="main">
                                    <div class="image">
                                        <img src="/storage/{{ $product->featuredImage->path }}" alt="{{ $product->featuredImage->name }}">
                                    </div>
                                </div>
                                <div class="sub">
                                    <!-- Swiper -->
                                    <div class="swiper-container product-image-swiper">
                                        <div class="swiper-wrapper">
                                            
                                            @isset($product->images_models)
                                                @foreach ($product->images_models as $image)
                                                    
                                                    <div class="swiper-slide">
                                                        <div class="slide-content">
                                                            <img src="/storage/{{ $image->path }}" alt="{{ $image->name }}">
                                                        </div>
                                                    </div>
                                                    
                                                @endforeach
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="product-info">
                                <div class="name">
            
                                </div>
                                <div class="description">
            
                                </div>
                                <div class="attributes">
            
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>


</x-app-layout>
