<x-app-layout>

    <div class="post-page mb-5">
        <div class="container">

            <div class="d-flex justify-content-md-center">
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
                            
                            <div class="variant my-5 table-responsive">

                                <table class="table my-4">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Kód</th>
                                            <th class="text-center">Ár</th>

                                            @isset($attributes)
                        
                                                @foreach ($attributes as $attr)

                                                <th>
                                                    {{ $attr }}
                                                </th>

                                                @endforeach
                                            
                                            @endisset
                                            
                                            <th class="text-end">Mennyiség</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($variants as $variant)
                                        
                                            <tr>
                                                <td style="padding: 12px 0;">
                                                    {{$variant->sku}}
                                                    <div class="pv-img-sample-box">
                                                        <img class="pv-image" src="{{ $variant->image_href }}" alt="" >
                                                        <div class="sample-big">
                                                            <img class="pv-image-big" src="{{ $variant->image_href }}" alt="" >
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="fw-bold" style="padding: 12px 0 12px 5px; white-space: nowrap;">{{ $variant->price }} .-</td>

                                                @php
                                                    $values = json_decode($variant->attr_values, true);
                                                @endphp
                                                
                                                @foreach ($values as $v)
                                                    <td style="padding: 12px 0;">{{ $v }}</td>
                                                @endforeach

                                                <td class="text-end">
                                                    <div class="cart-action-add">
                                                        <input type="number" min="1" max="2000" value="1" > db
                                                    
                                                        <div class="btn btn-primary btn-sm add-to-cart-btn ms-2"  
                                                            data-id="{{ $variant->id }}"
                                                        >
                                                            Kosárba
                                                        </div>
                                                    </div>
                                                </td>
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


</x-app-layout>
