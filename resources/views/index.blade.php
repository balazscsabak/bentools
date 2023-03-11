<x-app-layout>

    <div class="container-fluid">
        <div class="row hero-cont">
            <div class="col-12 col-lg-8 hero mt-4 pb-5">     
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

            <div class="col-12 col-lg-4 hero-right">
                @isset($latestPosts)
                    @foreach ($latestPosts as $post)

                        <div class="lp-wrapper">
                            <a class="post" href="{{ route('post', $post->slug) }}" style="text-decoration: none !important;">
                                <div class="lp-dot"></div>
                                <div class="lp-title">
                                    {{ $post->title }}
                                </div>
                                <div class="lp-exc">
                                    {{ $post->excerpt }}
                                </div>
                            </a>
                            
                        </div>

                    @endforeach
                @endisset
            </div>
        </div>
    </div>

    <!-- <div class="section-news mt-5">

        <div class="container">

            <div class="section-title d-none">
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

                <div class="text-center mt-5">
                    <a class="text-uppercase py-3 px-3 fs-5 bg-primary color-white btn btn-primary" href="{{ route('posts') }}">További híreink</a>
                </div>
            </div>
        </div>
    
    </div> -->
 
    <div class="section-related-items mt-5">
        
        <div class="container">
            
            <div class="d-inline-block position-relative mb-5">
                <h1>
                    Kiemelt Termékek
                </h1>
                <div class="icon position-absolute" style="top: 100%; right: 0;">
                    <i class="fas fa-angle-down"></i>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="col-12 col-lg-11">
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

    <div class="section-related-items">
        
        <div class="container">
            
            <div class="d-inline-block position-relative mb-5">
                <h1>
                    További Termékek
                </h1>
                <div class="icon position-absolute" style="top: 100%; right: 0;">
                    <i class="fas fa-angle-down"></i>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="col-12 col-lg-9">

                    <div class="row">
                        <div class="col-12 mb-5">
                            <div class="list-group d-flex flex-md-row text-center " id="list-tab" role="tablist">

                                @foreach ($featuredCategories as $fc)
                                    @if ($loop->index === 0) 
                                        <a class="list-group-item list-group-item-action active mx-2" id="fc-tab-{{  $loop->index  }}" data-bs-toggle="list" href="#fc-content-{{  $loop->index  }}" role="tab" aria-controls="fc-ccontent-{{  $loop->index  }}">
                                            {{ $fc['text'] }}
                                        </a>
                                    @else
                                        <a class="list-group-item list-group-item-action mx-2" id="fc-tab-{{  $loop->index  }}" data-bs-toggle="list" href="#fc-content-{{  $loop->index  }}" role="tab" aria-controls="fc-ccontent-{{  $loop->index  }}">
                                            {{ $fc['text'] }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 mb-5">
                            <div class="tab-content" id="nav-tabContent">
                                @foreach ($featuredCategories as $fc)
                                    @php
                                        $imageArr = explode(";", $fc['img']);
                                    @endphp
                                    @if ($loop->index === 0) 
                                        <div class="tab-pane fade show active" id="fc-content-{{  $loop->index  }}" role="tabpanel" aria-labelledby="fc-tab-{{  $loop->index  }}">
                                            <div class="fc-tab">
                                                @foreach ($fc['categories'] as $fcc)
                                                    @if($loop->last && count($fc['categories']) % 2 !== 0)

                                                        <a href="/category/{{ $fcc->slug }}" class="fc-tab-item last" style="background-image: url({{ $imageArr[$loop->index] ?? '' }})">
                                                            <h4>
                                                                {{ $fcc->name }}
                                                            </h4>
                                                        </a>
                                                    @else
                                                        <a href="/category/{{ $fcc->slug }}" class="fc-tab-item" style="background-image: url({{ $imageArr[$loop->index] ?? '' }})">
                                                            <h4>
                                                                {{ $fcc->name }}
                                                            </h4>
                                                        </a>
                                                    @endif
                                                    
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="tab-pane fade" id="fc-content-{{  $loop->index  }}" role="tabpanel" aria-labelledby="fc-tab-{{  $loop->index  }}">
                                            <div class="fc-tab">
                                                @foreach ($fc['categories'] as $fcc)
                                                    @if($loop->last && count($fc['categories']) % 2 !== 0)
                                                        <a href="/category/{{ $fcc->slug }}" class="fc-tab-item last" style="background-image: url({{ $imageArr[$loop->index] ?? '' }})">
                                                            <h4>
                                                                {{ $fcc->name }}
                                                            </h4>
                                                        </a>
                                                    @else
                                                        <a href="/category/{{ $fcc->slug }}" class="fc-tab-item" style="background-image: url({{ $imageArr[$loop->index] ?? '' }})">
                                                            <h4>
                                                                {{ $fcc->name }}
                                                            </h4>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div style="background-color: #d3d3d3;">
            <div class="container">
                <div class="row pb-5" >
                    <div class="col-12 col-md-7 p-4 px-5 offset-md-1" style="background-color: #e5e5e5; margin-top: -35px;">
                        <h2 class="mb-3">
                            Küldjön üzenetet
                        </h2>
                        <h5 class="mb-4">
                            {{ $offerMessage }}
                        </h5>
                        <div><a href="{{ route('message.index') }}" class="btn btn-primary d-block d-md-inline-block">Üzenet küldése</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-5">
        <div style="background-color: #e5e5e5;">
            <div class="container">
                <div class="row pt-5 justify-content-end" >
                    <div class="col-12 col-md-7 p-4 px-5 offset-md-1" style="background-color: #d3d3d3; margin-bottom: -35px;">
                    
                        <h2 class="mb-3">
                            Kérjen árajánlatot
                        </h2>
                        <h5 class="mb-4">
                            {{ $offerOffer }}    
                        </h5>
                        
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