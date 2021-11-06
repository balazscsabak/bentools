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
				<div class="form-check form-switch">
						<input value="1" class="form-check-input" type="checkbox" checked>    
				</div>
			</td>
		`)

		tr.append(`
			<td>
				<div class="input-group-sm pv-img-wrapper">
					<button class="pv-image-modal-btn" data-bs-toggle="modal" data-bs-target="#pv-image-modal">Variáns képe</button>
					<input type="hidden" class="form-control validate-not-null validate-for-button" value="">
				</div>
			</td>
		`)

		for (let index = 0; index < cellCount - 2; index++) {
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
						variant['active'] = $(td).find('input').prop('checked');
					}
					
					if(j === 1) {
						variant['image_href'] = $(td).find('input').val().trim();
					}

					if(j === 2) {
						variant['price'] = $(td).find('input').val().trim();
					}

					if(j === 3) {
						variant['code'] = $(td).find('input').val().trim();
					}

					if(j >= 4) {
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