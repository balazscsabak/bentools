<x-admin-layout>

    <div class="container mt-3  mb-5">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                {{ $message }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-block">
            
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                
            </div>
        @endif

        <h2>Termék módosítása</h2>

        <div class="my-3 d-flex">
            <a class="btn btn-secondary btn-sm me-2" href="{{ route('products.index') }}">Vissza</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value="Törlés" class="btn btn-danger btn-sm">
            </form>
        </div>
        
        <form action="{{ route('products.update', $product->id) }}" method="post">
            
            @csrf
            @method('PUT')

            <div class="mb-3 row">
                <div class="col-6">
                    <label style="font-size: 1.2rem;" for="name" class="form-label">Termék neve</label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                </div>
                <div class="col-6">
                    <label style="font-size: 1.2rem;" class="form-label">Kategória</label>
                    <select class="form-select" name="category" aria-label="Default select example">
                        
                        @foreach ($categories as $category)
        
                            <option {{ $category->id === $product->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                            
                        @endforeach
                        
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label style="font-size: 1.2rem;" for="exampleFormControlInput1" class="form-label">Termék leírása</label>
                <textarea style="min-height: 100px;" type="text" class="form-control" name="description">{{ $product->description }}</textarea>
            </div>

            <div>
                <input type="hidden" name="featured_image" id="featured_image" value={{ $product->featured_image }}>
                <input type="hidden" name="images" id="product_images" value={{ $product->images }}>

                <div class="row mb-4">

                    <div class="col-3">    
                        <label style="font-size: 1.2rem;">Termék képe</label>
                        
                        <div class="border border-secondary border-2 rounded-1" id="product-main-image-picker" data-bs-toggle="modal" data-bs-target="#product-main-img-modal" >
                            <img src='/storage/{{ $product->featuredImage->path }}' alt="{{ $product->featuredImage->name }}">                   
                        </div>
 
                        <div class="modal fade" id="product-main-img-modal" tabindex="-1" aria-labelledby="product-main-image-picker" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Válassz képet</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row">
                                        loading ..
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="set-product-main-image">Mentés</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-9">    
                        <label style="font-size: 1.2rem;">További képek</label>

                        <div id="product-images-picker" class="row border border-secondary border-2 rounded-1" data-bs-toggle="modal" data-bs-target="#product-images-modal" >
                            @if ($product->images)
                                @foreach ($product->images_models as $image)
                                    <div class="col-3"><img src="/storage/{{ $image->path }}"></div>
                                @endforeach
                            @else
                                <div class="no-image">
                                    Valassz képet!
                                </div>                    
                            @endif
                        </div>

                        <div class="modal fade" id="product-images-modal" tabindex="-1" aria-labelledby="product-images-picker" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Válassz képet/képeket</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row">
                                        loading ..
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="set-product-images">Mentés</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div>
                <label style="font-size: 1.2rem;">Attribútumok</label>
                <div class="row">
                    <div class="col-5">Attribútum neve</div>
                    <div class="col-5">Attribútum értéke</div>
                    <div class="col-2">Törlés</div>
                </div>
                <div id="product-attributes-wrapper">

                    @foreach ($product->attributes as $attribute)

                        <div class="attribute">
                            <input type="hidden" name="attr[{{ $loop->index }}][id]" value="{{ $attribute->id }}" class="attr-id">
                            <div class="row">
                                <div class="col-5">
                                    <div class="input-group input-group-sm mb-3">
                                        <input type="text" name="attr[{{ $loop->index }}][key]" value="{{ $attribute->key }}" class="form-control attr-key">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="input-group input-group-sm mb-3">
                                        <input type="text" name="attr[{{ $loop->index }}][value]" value="{{ $attribute->value }}" class="form-control attr-value">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button class=" btn btn-danger btn-sm product-del-attribute">X</button>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach

                    
                </div>
                <div class="text-center">
                    <button class="btn btn-sm btn-secondary" id="product-add-new-attribute">új attribútum</button>
                </div>
            </div>

            <input class="btn btn-primary" type="submit" value="Mentés">
        </form>

    </div>

</x-admin-layout>