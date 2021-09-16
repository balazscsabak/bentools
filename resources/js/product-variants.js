import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import { get } from "jquery";
import { validationNotNull } from './validation';

$(() => {

	$(document).on('click', '.p-variant-rm-row', function(e){
		$(e.target).closest('tr').remove();
	})

	$(document).on('click', '.p-variant-add-row', function(e){
		const cellCount = $(e.target).closest('.variant-attributes').find('table thead th').length;
		const tableBody = $(e.target).closest('.variant-attributes').find('table tbody');

		let tr = $('<tr>');

		tr.append(`
			<td>
				<div class="input-group-sm pv-img-wrapper">
					<button class="pv-image-modal-btn" data-bs-toggle="modal" data-bs-target="#pv-image-modal">Variáns képe</button>
					<input type="hidden" class="form-control validate-not-null validate-for-button" value="">
				</div>
			</td>
		`)

		for (let index = 0; index < cellCount - 1; index++) {
			tr.append(`
				<td>
					<div class="input-group-sm">
						<input type="text" class="form-control validate-not-null" >
					</div>
				</td>
			`);
		}

		tr.append(`
			<td>
				<div class="p-variant-rm-row">
					<i class="fas fa-minus"></i>
				</div>
			</td>
		`)

		tableBody.append(tr);
	})

	$(document).on('click', '.p-variant-add-col', function(e) {
		const cellCount = $(e.target).closest('.variant-attributes').find('table thead th').length;
		const thead = $(e.target).closest('.variant-attributes').find('table thead tr');
		const trs = $(e.target).closest('.variant-attributes').find('table tbody tr');

		thead.append(`
			<th>
				<div class="input-group-sm">
					<input type="text" class="form-control validate-not-null" >
				</div>
				<div class="p-variant-rm-col">
					<i class="fas fa-minus-circle"></i>
				</div>
			</th>
		`);

		trs.each((index, tr) => {
			let lastBeforeTd = $(tr).find('td').eq(cellCount - 1);
			lastBeforeTd.after(`
				<td>
					<div class="input-group-sm">
						<input type="text" class="form-control validate-not-null" >
					</div>
				</td>
			`);
		})
	})

	$(document).on('click', '.p-variant-rm-col', function(e) {
		let selectedTh = $(e.target).closest('th');
		let allThs = $(e.target).closest('thead').find('th');
		let index = allThs.index(selectedTh);

		const cellCount = $(e.target).closest('.variant-attributes').find('table thead th');
		const tableBody = $(e.target).closest('.variant-attributes').find('table tbody tr');

		cellCount.each((i, col) => {
			if(index === i) {
				$(col).remove();
				return false;
			} 
		})

		tableBody.each((_i, tr) => {
			let tds = $(tr).find('td');
			tds.each((i, coll) => {
				if(i === index) {
					$(coll).remove();
					return false;
				}
			})
		})
	})

	// $(document).on('click', '.p-add-new-variant', (e) => {
	// 	e.preventDefault();

	// 	let variantsCount = $('.product-variant').length;
		
	// 	let variantContent = `
	// 		<div class="product-variant col-12 col-lg-8 with-shadow p-4 mb-5">
	// 			<div class="p-variant-delete">
	// 				<i class="fas fa-times"></i>
	// 			</div>
				
	// 			<div class="variant-content">
	// 				<label class="form-label">Leírás</label>
	// 				<textarea class="form-control product-variant-content"></textarea>
	// 			</div>

	// 			<div class="variant-attributes my-4">
	// 				<div class="d-flex justify-content-between mb-3">
	// 					<label class="form-label">Termék attribútumok</label>
	// 					<i class="fas fa-plus-circle p-variant-add-col"></i>
	// 				</div>

	// 				<table class="table table-sm table-borderless">
	// 					<thead>
	// 						<tr>
	// 							<th>
	// 								<div class="input-group-sm">
	// 									<input type="text" class="form-control" value="Kép" readonly>
	// 								</div>
	// 							</th>
	// 							<th>
	// 								<div class="input-group-sm">
	// 									<input type="text" class="form-control" value="Kód" readonly>
	// 								</div>
	// 							</th>
	// 						</tr>
	// 					</thead>
	// 					<tbody>
	// 					</tbody>
	// 				</table>

	// 				<div>
	// 					<i class="fas fa-plus-circle p-variant-add-row"></i>
	// 				</div>
	// 			</div>
	// 		</div>
	// 	`;

	// 	$('#product-variants').append(variantContent);

	// 	let selectedTextarea = $('.product-variant-content').eq(variantsCount);
		
	// 	ClassicEditor.create(selectedTextarea.get(0), {
    //         ckfinder: {
    //             uploadUrl:
    //                 "/admin/media/upload-editor?_token=" +
    //                 $("[name='_token']").val(),
    //             openerMethod: "popup",
    //             withCredentials: true,
    //         },
    //     });
		
	// })

	// $(document).on('click', '.p-variant-delete', function(e) {
	// 	$(e.target).closest('.product-variant').remove();
	// })

	// $(document).on('submit', '#p-form', function(e) {
		
	// 	if(!validationNotNull()) {
	// 		alert('Hiányzó adat!');
	// 		return false;
	// 	}
	// });

	// $(document).on('submit', '#p-variant-form', function(e) {

	// 	if(!validationNotNull()) {
	// 		alert('Hiányzó adat!');
	// 		return false;
	// 	}

	// 	let variantsWrappers = $('#product-variants .product-variant');
	// 	let variants = [];
		
	// 	variantsWrappers.each((i, wrapper) => {
	// 		let variantData = {};
	// 		let content = $(wrapper).find('.variant-content .product-variant-content').val();
	// 		let attributesTable = $(wrapper).find('.variant-attributes');
	// 		let attributesThs = attributesTable.find('table th');
	// 		let attributesCount = attributesTable.find('table th').length;
	// 		let attributesRows = attributesTable.find('table tbody tr');

	// 		variantData.types = [];
	// 		variantData.codes = [];
	// 		let keys = [];

	// 		attributesThs.each((i, el) => {
	// 			let inputValue = $(el).find('input').val();
	// 			keys.push(inputValue);
	// 		})

	// 		variantData.keys = keys;

	// 		let attributeCodes = [];

	// 		attributesRows.each((i, row) => {
	// 			let tds = $(row).find('td');

	// 			let attributeValues = [];

	// 			tds.each((index, td) => {
	// 				if(attributesCount > index){
	// 					let value = $(td).find('input').val();
	// 					attributeValues.push(value);
	// 				}
	// 			})
	// 			attributeCodes.push( Math.random().toString(36).substr(2, 9) );

	// 			variantData.types.push(attributeValues);
	// 		})

	// 		variantData.codes = attributeCodes;

	// 		variantData.content = content;

	// 		variants.push(variantData);
	// 	})

	// 	let input = $("<input>")
    //            .attr("type", "hidden")
    //            .attr("name", "variants").val(JSON.stringify(variants));

	// 	$('#p-variant-form').append(input);
		
	// })

	$(document).on('submit', '#p-variant-form', function(e) {

		if(!validationNotNull()) {
			alert('Hiányzó adat!');
			return false;
		}

		let variantsWrapper = $('#product-variants .product-variant').first();
		let attributesTable = $(variantsWrapper).find('.variant-attributes');
		let attributesThs = attributesTable.find('table th');
		let attributesCount = attributesTable.find('table th').length;
		let attributesRows = attributesTable.find('table tbody tr');

		let variants = [];

		attributesRows.each((i, row) => {

			let variant = {};
			let variantId = $(row).find('.hidden-variant-id').val();

			variant['attr'] = [];
			variant['attr_values'] = [];
			
			if(variantId) {
				variant['variant_id'] = variantId; 
			}
			
			$(row).find('td').each((j, td) => {
				if(j < attributesCount) {
					if(j === 0) {
						variant['image_href'] = $(td).find('input').val().trim();
					}

					if(j === 1) {
						variant['price'] = $(td).find('input').val().trim();
					}

					if(j === 2) {
						variant['code'] = $(td).find('input').val().trim();
					}

					if(j >= 3) {
						variant['attr'].push($(attributesThs[j]).find('input').val().trim());
						variant['attr_values'].push($(td).find('input').val().trim());
					}
				}
			})
			variants.push(variant);
		})

		let input = $("<input>")
			.attr("type", "hidden")
			.attr("name", "variants").val(JSON.stringify(variants));

		console.log(variants);
		$('#p-variant-form').append(input);
	})

	$(document).on('click', '.pv-image-modal-btn', function(e) {
		// pv-image-modal
		e.preventDefault();
	}) 

	$('#pv-image-modal').on('show.bs.modal', function(e){

		let eventButton = e.relatedTarget;
		let selectedImgSrc = $(eventButton).siblings('input').val();
		
		$(e.target).find('#pv-save-image-btn').data('target', eventButton);

		$.ajax({
            method: 'GET',
            url: '/admin/media/images',
            success: (res) => {

                if(res.length > 0) {
                    $('#pv-image-modal .modal-body').empty();

                    res.map(img => {
                        let imagesHtml = `
                            <div class="col-3 product-main-img-selectable">
                                <img src="/storage/${img.path}" alt="${img.name}" data-id="${img.id}">
                            </div>
                        `;

                        if(selectedImgSrc == '/storage/' + img.path) {
                            imagesHtml = `
                                <div class="col-3 product-main-img-selectable">
                                    <img class="selected" src="/storage/${img.path}" alt="${img.name}" data-id="${img.id}">
                                </div>
                            `;
                        }

                        $('#pv-image-modal .modal-body').append(imagesHtml)
                    })
                }

            },
            error: (err) => {
                console.log(err)
            }
        })
	})

	$(document).on('click', '#pv-save-image-btn', function(e) {
		let target = $(e.target).data('target');

		$('#pv-image-modal .product-main-img-selectable img').each(function(i, el){

            if($(el).hasClass('selected')){
				$(target).siblings('input').data('id', $(el).data('id'))
				$(target).siblings('input').val($(el).attr('src'));
            }

        }) 
	})
})