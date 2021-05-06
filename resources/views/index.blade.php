<x-app-layout>
    <div class="hero">     
        <!-- Slider main container -->
        <div class="swiper-container hero-swiper">
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

    <div class="section-news">

        <div class="container">

            <div class="section-title">
                <h1>
                    Hírek
                </h1>
                <div class="icon">
                    <i class="fas fa-angle-down"></i>
                </div>
            </div>

            <div class="news row justify-content-md-center gx-2 ">
                @isset($latestPosts)
                    @foreach ($latestPosts as $post)

                        <x-post :post="$post"/>

                    @endforeach
                @endisset
            </div>
        </div>
    
    </div>
 
    <div class="section-related-items">
        
        <div class="container">
            
            <div class="section-title">
                <h1>
                    Kiemelt Termékek
                </h1>
                <div class="icon">
                    <i class="fas fa-angle-down"></i>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="col-9">
                    <div class="related-items row justify-content-md-center gx-4">
                        @isset($relatedProducts)
                            @foreach ($relatedProducts as $product)
            
                                <x-related-item :product="$product"/>
            
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="contact-us" style="background-image: linear-gradient(#000000d8, #000000c7), url('/storage/images/1620209338.jpg')">

        <div class="container">
            <div class="contact-us-wrapper">
                <div class="content">
                    <div class="left col">
                        <div class="text">
                            <h1>
                                Küldjön üzenetet
                            </h1>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor molestiae impedit et cum nihil labore!
                            </p>
                        </div>
                        <div><a href="#" class="btn btn-primary">Üzenet küldése</a></div>
                    </div>
                    <div class="divider"></div>
                    <div class="right col">
                        <div class="text">
                            <h1>
                                Kérjen Árajánlatot
                            </h1>
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Harum optio voluptas neque quia. Nesciunt, architecto aliquid!
                            </p>
                        </div>
                        
                        <div><a href="#" class="btn btn-primary">ÁRAJÁNLATOT KÉREK</a></div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

    <div class="shipping">

        <div class="container">

            <div class="shipping-wrapper d-flex justify-content-center">
                <div class="col-8 text-center">
                    <h1>Szállítás</h1>
                    <i class="fas fa-dolly"></i>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi architecto excepturi, eveniet odio dignissimos placeat cum quae? Voluptas accusamus labore iusto molestias, debitis nihil dolorum, fugiat aliquid sequi inventore facere totam eveniet unde fugit provident. Placeat facilis sed voluptate at in modi perspiciatis dolore, repellendus, maxime magni eos! Optio explicabo sequi illum dignissimos labore voluptatibus consequatur dicta libero, repellendus provident!</p>
                </div>
            </div>

        </div>

    </div>

    <div class="contact">

        <div class="container">

            <div class="contact-wrapper d-flex justify-content-center">
                <div class="col-8 text-center">
                    <div class="row">
                        <div class="email col-6">
                            <div class="icon"><i class="fas fa-at"></i></div>
                            <h1>
                                balazs.csabak@gmail.com
                            </h1>
                        </div>
                        <div class="phone col-6">
                            <div class="icon"><i class="fas fa-phone-alt"></i></div>
                            <h1>
                                +36 30 947 7500
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>