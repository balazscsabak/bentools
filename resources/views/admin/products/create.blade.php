<x-admin-layout>

    <div class="container mt-3 mb-5">
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

        <h5>Új termék létrehozása</h5>

        <form action="{{ route('products.store') }}" method="post">
            
            @csrf

            <div class="mb-3">
                <label style="font-size: 1.2rem;" for="name" class="form-label">Termék neve</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="mb-3">
                <label style="font-size: 1.2rem;" for="exampleFormControlInput1" class="form-label">Termék leírása</label>
                <textarea type="text" class="form-control" name="description"></textarea>
            </div>

            <label style="font-size: 1.2rem;" class="form-label">Kategória</label>
            <select class="form-select" name="category" aria-label="Default select example">

                @foreach ($categories as $category)

                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    
                @endforeach
                
            </select>

            <div>
                <input type="hidden" name="featured_image" id="featured_image">
                <input type="hidden" name="images" id="product_images">
                <input type="hidden" name="category_image" id="category_image">

                <div class="row mb-4">

                    <div class="col-3">    
                        <label style="font-size: 1.2rem;">Termék képe</label>
                        
                        <div class="border border-secondary border-2 rounded-1" id="product-main-image-picker" data-bs-toggle="modal" data-bs-target="#product-main-img-modal" >
                            <div class="no-image">
                                Valassz képet!
                            </div>                    
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

                    <div class="col-3">    
                        <label style="font-size: 1.2rem;">Termék kategória képe</label>
                        
                        <div class="border border-secondary border-2 rounded-1" id="product-category-image-picker" data-bs-toggle="modal" data-bs-target="#product-category-img-modal" style="min-height: 50px">
                            <div class="no-image">
                                Valassz képet!
                            </div>      
                        </div>
 
                        <div class="modal fade" id="product-category-img-modal" tabindex="-1" aria-labelledby="product-category-image-picker" aria-hidden="true">
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

                    <div class="col-12 mt-3">    
                        <label style="font-size: 1.2rem;">További képek</label>

                        <div id="product-images-picker" class="row border border-secondary border-2 rounded-1" data-bs-toggle="modal" data-bs-target="#product-images-modal" >
                            <div class="no-image">
                                Valassz képet!
                            </div>                    
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

                <div id="product-attributes-wrapper"></div>

                <div class="text-center">
                    <button class="btn btn-sm btn-primary" id="product-add-new-attribute">új attribútum</button>
                </div>
            </div>

            <input class="btn btn-primary" type="submit" value="Mentés">
        </form>

    </div>

</x-admin-layout>