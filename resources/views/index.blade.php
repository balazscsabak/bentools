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
                <div class="col-12 col-lg-9">
                    <div class="related-items row justify-content-center gx-4">
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

    <div class="contact-us lazy" data-bg-multi="linear-gradient(#000000d8, #000000c7), url('/storage/images/1620209338.jpg')">

        <div class="container">
            <div class="contact-us-wrapper">
                <div class="content flex-column flex-md-row">
                    <div class="left col mb-5 mb-md-0 ">
                        <div class="text">
                            <h1 class="text-center text-md-end">
                                Küldjön üzenetet
                            </h1>
                            <p class="text-center text-md-end">
                                {{ $offerMessage }}
                            </p>
                        </div>
                        <div><a href="{{ route('message.index') }}" class="btn btn-primary d-block d-md-inline-block">Üzenet küldése</a></div>
                    </div>
                    <div class="divider"></div>
                    <div class="right col">
                        <div class="text">
                            <h1 class="text-center text-md-start">
                                Kérjen árajánlatot
                            </h1>
                            <p class="text-center text-md-start">
                                {{ $offerOffer }}    
                            </p>
                        </div>
                        
                        <div><a href="{{ route('offer') }}" class="btn btn-primary d-block d-md-inline-block">ÁRAJÁNLATOT KÉREK</a></div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

    <div class="shipping-section">

        <div class="container">

            <div class="shipping-wrapper d-flex justify-content-center">
                <div class="col-8 text-center">
                    <h1>Szállítás</h1>
                    <i class="fas fa-dolly"></i>
                    {!! $shipping !!}
                </div>
            </div>

        </div>

    </div>

    <div class="contact-section">

        <div class="container">

            <div class="contact-wrapper d-flex justify-content-center">
                <div class="col-8 text-center">
                    <div class="row">
                        <div class="email col-12 col-md-6 mb-4 mb-md-0">
                            <div class="icon"><i class="fas fa-at"></i></div>
                            <h1>
                                {{ $email }}
                            </h1>
                        </div>
                        <div class="phone col-12 col-md-6">
                            <div class="icon"><i class="fas fa-phone-alt"></i></div>
                            <h1>
                                {{ $phone }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>