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
        
        <form action="{{ route('products.update', $product->id) }}" method="post" id="p-variant-form">
            
            @csrf
            @method('PUT')

            <div class="mb-3 mt-3">
                <div class="form-check form-switch">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Termék elérhető?</label>
                    <input value="available" name="available" id="available" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $product->available ? 'checked' : null}}>
                </div>
            </div>
            
            <div class="mb-3 row">
                <div class="col-6">
                    <label style="font-size: 1.2rem;" for="name" class="form-label">Termék neve</label>
                    <input type="text" class="form-control validate-not-null" name="name" value="{{ $product->name }}">
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

            <div class="mb-3 row">
                <label style="font-size: 1.2rem;" for="unit" class="form-label">Egység</label>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <input class="form-control validate-not-null" name="unit" type="number" min="1" max="100" value="{{ $product->unit }}" step="1" >
                    </div>
                    <div class="col-auto">
                        / egység
                    </div>
                </div>
            </div>
            
            <div>
                <input type="hidden" name="category_image" id="category_image" value={{ $product->category_image_id }}>
                <input type="hidden" name="featured_image" id="featured_image" value={{ $product->featured_image }}>

                <div class="row mb-4">

                    <div class="col-3">    
                        <label style="font-size: 1.2rem;" class="form-label">Termék képe</label>
                        
                        <div class="border with-shadow" id="product-main-image-picker" data-bs-toggle="modal" data-bs-target="#product-main-img-modal" >
                            @if (isset($product->featuredImage))
                                <img src='/storage/{{ $product->featuredImage->path }}' alt="{{ $product->featuredImage->name }}">                   
                            @else
                                <div class="no-image">
                                    Valassz képet!
                                </div>   
                            @endif
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
                        
                        <div class="border with-shadow" id="product-category-image-picker" data-bs-toggle="modal" data-bs-target="#product-category-img-modal" style="min-height: 50px">
                            <img src='/storage/{{ isset($product->categoryImage) ? $product->categoryImage->path : "" }} ' alt="{{ isset($product->categoryImage) ? $product->categoryImage->name : ''}}">                   
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

            <div class="mb-3">
                <label style="font-size: 1.2rem;" for="exampleFormControlInput1" class="form-label">Termék leírása</label>
                <textarea style="min-height: 100px;" type="text" class="form-control validate-not-null product-variant-content" name="description">{{ $product->description }}</textarea>
            </div>

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
												<input type="text" class="form-control" value="Nettó Ár" readonly>
											</div>
										</th>
										<th>
											<div class="input-group-sm">
												<input type="text" class="form-control" value="Bruttó Ár" readonly>
											</div>
										</th>
										<th>
											<div class="input-group-sm">
												<input type="text" class="form-control" value="Kód" readonly>
											</div>
										</th>

                                        @foreach ($variants['attributes'] as $attr)

                                            <th>
                                                <div class="input-group-sm">
                                                    <input type="text" class="form-control" value="{{ $attr }}" >
                                                    <div class="p-variant-rm-col">
                                                        <i class="fas fa-minus-circle"></i>
                                                    </div>
                                                </div>
                                            </th>

                                        @endforeach
									</tr>
								</thead>
								<tbody>
                                    @foreach ($variants['items'] as $variant)
                                        <tr>
                                            <input type="hidden" class="hidden-variant-id" value="{{ $variant['id'] }}">
                                            
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input value="1" class="form-check-input" type="checkbox" {{ $variant['active'] ? 'checked' : null}}>    
                                                </div>
                                            </td>

                                            <td>
                                                <div class="input-group-sm pv-img-wrapper">
                                                    <button class="pv-image-modal-btn" data-bs-toggle="modal" data-bs-target="#pv-image-modal">Variáns képe</button>
                                                    <input type="hidden" class="form-control validate-not-null validate-for-button" value="{{ $variant['image_href'] }}">
                                                </div>
                                            </td>
                                            
                                            <td>
                                                <div class="input-group-sm">
                                                    <input value="{{ $variant['net_price'] }}" type="text" class="form-control validate-not-null" >
                                                </div>
                                            </td>

                                            <td>
                                                <div class="input-group-sm">
                                                    <input value="{{ $variant['price'] }}" type="text" class="form-control validate-not-null" >
                                                </div>
                                            </td>

                                            <td>
                                                <div class="input-group-sm">
                                                    <input value="{{ $variant['sku'] }}" type="text" class="form-control validate-not-null" >
                                                </div>
                                            </td>

                                            @foreach ($variant['attr_values'] as $attr)
                                                <td>
                                                    <div class="input-group-sm">
                                                        <input value="{{ $attr }}" type="text" class="form-control validate-not-null" >
                                                    </div>
                                                </td>
                                            @endforeach

                                            <td>
                                                <div class="p-variant-rm-row">
                                                    <i class="fas fa-minus"></i>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
								</tbody>

							</table>

							<div>
								<i class="fas fa-plus-circle p-variant-add-row"></i>
							</div>
						</div>
					</div>

				</div>
			</div>

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

            <input class="btn btn-primary" type="submit" value="Mentés">
        </form>

    </div>

</x-admin-layout>