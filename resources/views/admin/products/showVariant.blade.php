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

        <h5>Termék (variáns) módosítás</h5>

        <div class="my-3 d-flex">
            <a class="btn btn-secondary btn-sm me-2" href="{{ route('products.index') }}">Vissza</a>
			<form action="{{ route('admin.products.destroy-variant', $product->id) }}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value="Törlés" class="btn btn-danger btn-sm">
            </form>
        </div>

        <form action="{{ route('admin.products.update-variant', $product->id) }}" method="post" id="p-variant-form">
            @method('PUT')
            @csrf

            <div class="mb-3 row">
                <div class="col-6">
                    <label class="form-label">Termék neve</label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                </div>

                <div class="col-6">
                    <label class="form-label">Kategória</label>
                    <select class="form-select" name="category">
        
                        @foreach ($categories as $category)
        
                            <option {{ $category->id === $product->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                            
                        @endforeach
                        
                    </select>
                </div>

            </div>

            <div>
                <input type="hidden" name="featured_image" id="featured_image" value={{ $product->featured_image }}>
                <input type="hidden" name="category_image" id="category_image" value={{ $product->category_image_id }}>

                <div class="row mb-4 mt-4">

                    <div class="col-3">    
                        <label class="form-label">Termék képe</label>
                        
                        <div class="border with-shadow" id="product-main-image-picker" data-bs-toggle="modal" data-bs-target="#product-main-img-modal" style="min-height: 50px">
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
                        <label class="form-label">Termék kategória képe</label>
                        
                        <div class="border with-shadow" id="product-category-image-picker" data-bs-toggle="modal" data-bs-target="#product-category-img-modal" style="min-height: 50px">
                            @if (isset($product->categoryImage))
								<img src='/storage/{{ $product->categoryImage->path }}' alt="{{ $product->categoryImage->name }}">                   
							@else
								<div class="no-image">
									Valassz képet!
								</div>   
							@endif   
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

			<hr>

			<div class="product-variants-wrapper">
				<h5>Termék variánsai</h5>

				<div class="mt-3 mb-4">
					Új variáns <button class="btn btn-sm btn-primary ms-2 p-add-new-variant"><i class="fas fa-plus"></i></button>
				</div>

				<div id="product-variants" class="mb-4 row justify-content-center">
					
					@isset($variants)
						@foreach ($variants as $variant)
							@php
								$v = json_decode($variant->variants, true);
							@endphp

							<div class="product-variant col-12 col-lg-8 with-shadow p-4 mb-5">
								@if (!$loop->first)
									<div class="p-variant-delete">
										<i class="fas fa-times"></i>
									</div>
								@endif

								<div class="variant-content">
									<label class="form-label">Leírás</label>
									<textarea class="form-control product-variant-content">{{ $v['content'] }}</textarea>
								</div>
		
								<div class="variant-attributes my-4">
									<div class="d-flex justify-content-between mb-3">
										<label class="form-label">Termék attribútumok</label>
										<i class="fas fa-plus-circle p-variant-add-col"></i>
									</div>
		
									<table class="table table-sm table-borderless">
										<thead>
											<tr>

												@foreach ($v['keys'] as $k)
													@if ($loop->first)
														<th>
															<div class="input-group-sm">
																<input type="text" class="form-control" value="Kód" readonly>
															</div>
														</th>
													@else 
														<th>
															<div class="input-group-sm">
																<input type="text" class="form-control" value="{{ $k }}">
															</div>
															<div class="p-variant-rm-col">
																<i class="fas fa-minus-circle"></i>
															</div>
														</th>	
													@endif
												@endforeach

											</tr>
										</thead>
										<tbody>
											@foreach ($v['types'] as $type)

												<tr>
												
												@foreach ($type as $val)
													<td>
														<div class="input-group-sm">
															<input type="text" class="form-control" value="{{ $val }}">
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
						@endforeach
					@endisset
					


				</div>
			</div>

            <input class="btn btn-primary" type="submit" value="Mentés">
        </form>

    </div>

</x-admin-layout>