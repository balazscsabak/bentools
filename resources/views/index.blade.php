<x-app-layout>

    <div class="hero">     
        <!-- Slider main container -->
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @isset($slideshow)
                    @foreach ($slideshow as $slide)
                        <x-slide :slide="$slide"/>
                    @endforeach
                @endisset
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
        
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    <div class="container">
        <h1 class="text-center">Hírek</h1>

        <div class="news row justify-content-md-center gx-2 ">
            @isset($latestPosts)
                @foreach ($latestPosts as $post)

                    <x-post :post="$post"/>

                @endforeach
            @endisset
        </div>
    </div>

    <div class="container">
        <h1 class="text-center">Kiemelt Termékek</h1>

        <div class="related-items row justify-content-md-center gx-5">
            @isset($relatedProducts)
                @foreach ($relatedProducts as $product)

                    <x-related-item :product="$product"/>

                @endforeach
            @endisset
        </div>
    </div>
</x-app-layout>