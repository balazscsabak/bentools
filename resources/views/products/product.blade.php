<x-app-layout>

    <div class="post-page mb-5">
        <div class="container">

            <div class="d-flex justify-content-md-center position-relative">
                <div class="col-12 col-md-7">
                    <div class="post">

                        <div class="title">
                            <h1>
                                {{ $product->name }}
                            </h1>
                        </div>

                        <div class="featured-image">
                            @if (isset($product->featuredImage))
                                <img id="product-featured-image"  src="/storage/{{ $product->featuredImage->path }}">
                            @else
                                <img id="product-featured-image" src="/storage/images/default-product.png">
                            @endif
                        </div>

                        <div class="description">
                            {!! $product->description !!}
                        </div>

                        <div class="content">
                            
                            <div class="variant my-5">

                                <table class="table my-4">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Kód</th>
                                            <th class="text-center">Ár</th>
                                            <th></th>
                                            <th>Megmunkálási paraméterek</th>
                                            <th class="text-end">Mennyiség</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($variants as $variant)
                                        
                                            <tr class="position-relative"
                                                @if (!$variant->active)
                                                style="opacity: 0.5;"
                                                @endif
                                            >
                                                <td style="padding: 12px 0;">
                                                    {{$variant->sku}}
                                                    <div class="pv-img-sample-box">
                                                        <img class="pv-image" src="{{ $variant->image_href }}" alt="" >
                                                        <div class="sample-big">
                                                            <img class="pv-image-big" src="{{ $variant->image_href }}" alt="" >
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="fw-bold" style="padding: 12px 0 12px 5px; white-space: nowrap;">
                                                    
                                                    <div><small style="font-size: 12px; color: #818181; font-weight:400;">Bruttó: {{ $variant->price }} .-</small></div>
                                                    <div>{{ $variant->net_price }} .-</div>
                                                </td>

                                                @php
                                                    $values = json_decode($variant->attr_values, true);
                                                @endphp
                                                
                                                <td style="padding: 12px 0;">
                                                    @foreach ($values as $ind => $v)
                                                        <div class="ps-2" style="white-space: nowrap;">
                                                            {{ $attributes[$ind] }} : {{ $v }}
                                                        </div>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @if ($product->pdf_link)
                                                        <a href="/storage/{{ $product->pdf_link }}" target="_blank" class="text-decoration-none">
                                                            <small>Letöltés</small>
                                                            <br>
                                                            <i class="mt-1 fas fa-file-download"></i>
                                                        </a>
                                                    @endif
                                                </td>

                                                <td class="text-end">
                                                    @if (!$variant->active)
                                                        <div class="">Beszerzés alatt!</div>
                                                    @else
                                                        <div class="cart-action-add ">
                                                            <input type="number" class="unit-counter" min="{{ $product->unit }}" max="5000" value="{{ $product->unit }}" step="{{ $product->unit }}"> db
                                                        
                                                            <div class="btn btn-primary btn-sm add-to-cart-btn ms-2"  
                                                                data-id="{{ $variant->id }}"
                                                            >
                                                                Kosárba
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </div>
                </div>
                @if (!$product->available)
                    <div class="product-not-available">
                        <div class="text fs-1 fw-bold">
                            Beszerzés alatt!
                        </div>
                    </div>
                @endif
            </div>

        
        </div>
    </div>


</x-app-layout>
