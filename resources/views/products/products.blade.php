<x-app-layout>

    <div class="products-page mt-3 pb-5">
        <div class="container">
            <div class="d-flex justify-content-center mb-5">
                <div class="col-11 col-md-7">

                    <div class="products">
                        <h1>
                            Termékek
                        </h1>

                        <div class="products-filter-wrapper">
                            <div class="filter">
                                <h1>Szűrő</h1>
                                <div class="name">
                                    <div class="mb-3 input-group-sm">
                                        <label class="form-label filter-label">Név <span class="filter-reset filter-reset--name"><i class="fas fa-redo-alt"></i> alaphelyzet</span></label>
                                        <input name="filter-name" type="text" class="form-control" id="products-filter-name"">
                                    </div>
                                </div>
                                <div class="category">
                                    <label class="form-label filter-label">Kategória: <span class="filter-reset filter-reset--category"><i class="fas fa-redo-alt"></i> alaphelyzet</span></label>
                                    <select name="filter-category" id="products-filter-category" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        @foreach ($mainCatsWithChild as $mainCat => $data)
                                            <option value="{{ $data['id'] }}">{{ $mainCat }}</option> 
                                        
                                            @isset($data['sub'])
                                                
                                                @foreach ($data['sub'] as $sub)
                                                    <option value="{{ $sub['id'] }}">{{ $sub['name'] }}</option> 
                                                @endforeach

                                            @endisset

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>

            <div class="row gy-3 related-items products-wrapper justify-content-center">
                @foreach ($products as $product)
            
                    <x-related-item :product="$product"/>

                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
