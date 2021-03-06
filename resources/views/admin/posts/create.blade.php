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
        
        <h2 class="mb-4">Új poszt</h2>
        
        <form method="POST" action="{{ route('posts.store') }}" class="row">
            @csrf
            
            <div class="col-md-6">
                <label for="title" class="form-label">Cím</label>
                <input name="title" type="text" class="form-control" id="title">
            </div>

            <div class="col-md-6">
                <label for="excerpt" class="form-label">Excerpt</label>
                <textarea name="excerpt" class="form-control" id="excerpt"></textarea>
            </div>
            

            <div class="col-3">    
                <input type="hidden" name="featured_image" id="featured_image" value>

                <label>Kiemelt kép</label>
                
                <div class="with-shadow" id="product-main-image-picker" data-bs-toggle="modal" data-bs-target="#product-main-img-modal" >
                    <div class="no-img-selected">
                        Kérlek válassz képet
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

            <div class="col-md-12 mt-4">
                <label for="content" class="form-label">Kontent</label>
                <textarea name="content" class="form-control" id="post-content-editor"></textarea>
            </div>
           
            <div>
                <input class="btn btn-primary mt-5 d-inline-block" type="submit" value="Mentés">
            </div>
        </form>
    </div>

</x-admin-layout>
