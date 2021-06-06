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
                                <img id="product-featured-image">
                            @endif
                        </div>

                        <div class="content">
                            @isset($variants)
                                
                                @foreach ($variants as $variant)
                                
                                    @php
                                        $v = json_decode($variant->variants, true);
                                    @endphp

                                    <div class="variant my-5">
                                        <div class="cont">
                                            {!! $v['content'] !!}
                                        </div>

                                        <table class="table my-4">
                                            <thead>
                                                <tr>
                                                    @foreach ($v['keys'] as $item)
                                                        @if ($loop->first)
                                                            @continue
                                                        @else
                                                            <th>
                                                                {{ $item }}
                                                            </th>
                                                        @endif
                                                    @endforeach
                                                    <th class="text-end">Mennyiség</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($v['types'] as $item)
                                                    <tr>
                                                        @foreach ($item as $i)
                                                            @if ($loop->first)
                                                                @continue
                                                            @endif
                                                            @if ($loop->index == 1)
                                                                <td style="padding: 12px 0;">
                                                                    {{ $i }}
                                                                
                                                                    <div class="pv-img-sample-box">
                                                                        <img class="pv-image" src="{{ $item[0] }}" alt="" >
                                                                        <div class="sample-big">
                                                                            <img class="pv-image-big" src="{{ $item[0] }}" alt="" >
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <td style="padding: 12px 0;">{{ $i }}</td>
                                                            @endif
                                                        @endforeach
                                                        <td class="text-end">
                                                            <div class="cart-action-add">
                                                                <input type="number" min="1" max="200" value="1" > db
                                                            
                                                                <div class="btn btn-primary btn-sm add-to-cart-btn ms-2" data-name="{{ $product->name . '-' . $item[1] }}" data-id="{{ $variant->id . '[~]' . $v['codes'][$loop->index] }}">
                                                                    Hozzáad
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>


                                    </div>

                                @endforeach

                            @endisset
                        </div>

                    </div>
                </div>
            </div>

        
        </div>
    </div>


</x-app-layout>
