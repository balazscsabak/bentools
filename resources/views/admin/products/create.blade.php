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

        <h2>Új termék létrehozása</h2>

        <div class="my-3">
            <a class="btn btn-secondary btn-sm me-2" href="{{ route('products.index') }}">Vissza</a>
        </div>

        <form action="{{ route('products.store') }}" method="post" id="p-variant-form">
            
            @csrf

            <div class="mb-3 row">
                <div class="col-6">
                    <label style="font-size: 1.2rem;" class="form-label">Termék neve</label>
                    <input type="text" class="form-control validate-not-null" name="name">
                </div>

                <div class="col-6">
                    <label style="font-size: 1.2rem;" class="form-label">Kategória</label>
                    <select class="form-select" name="category">
        
                        @if ($categories)
                            @foreach ($categories as $category)
            
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            
                            @endforeach 
                        @endif

                    </select>
                </div>

            </div>

            <div>
                <input type="hidden" name="category_image" id="category_image">
                <input type="hidden" name="featured_image" id="featured_image">

                <div class="row mb-4 mt-4">

                    <div class="col-3">    
                        <label style="font-size: 1.2rem;" class="form-label">Termék képe</label>
                        
                        <div class="border with-shadow" id="product-main-image-picker" data-bs-toggle="modal" data-bs-target="#product-main-img-modal" >
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
                        <label style="font-size: 1.2rem;" class="form-label">Termék kategória képe</label>
                        
                        <div class="border with-shadow" id="product-category-image-picker" data-bs-toggle="modal" data-bs-target="#product-category-img-modal" >
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

                </div>
            </div>

            <div class="row">
                <div class="col-12">    
                    <label style="font-size: 1.2rem;" class="form-label">Termék leírása</label>
                    <textarea name="description" class="form-control product-variant-content"></textarea>
                </div>
            </div>

			<hr>

			<div class="product-variants-wrapper">
				<h5 class="mb-2">Termék variánsai</h5>

				<div id="product-variants" class="mb-4 row justify-content-center">
					
					<div class="product-variant col-12 mb-2">

						<div class="variant-attributes my-4">
							<div class="d-flex justify-content-end mb-3">
								<i class="fas fa-plus-circle p-variant-add-col"></i>
							</div>

							<table class="table table-sm table-borderless">
								<thead>
									<tr>
                                        <th></th>
										<th>
											<div class="input-group-sm">
												<input type="text" class="form-control" value="Kép" readonly>
											</div>
										</th>
										<th>
											<div class="input-group-sm">
												<input type="text" class="form-control" value="Ár" readonly>
											</div>
										</th>
										<th>
											<div class="input-group-sm">
												<input type="text" class="form-control" value="Kód" readonly>
											</div>
										</th>
									</tr>
								</thead>
								<tbody>
								</tbody>

							</table>

							<div>
								<i class="fas fa-plus-circle p-variant-add-row"></i>
							</div>
						</div>
					</div>

				</div>
			</div>

            <input class="btn btn-primary" type="submit" value="Mentés">
        </form>

        <div class="modal fade" id="pv-image-modal" tabindex="-1" aria-labelledby="pv-image-modalr" aria-hidden="true">
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
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="pv-save-image-btn">Mentés</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>