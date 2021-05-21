$(function () {

    $('#product-category-img-modal').on('show.bs.modal', function(e){
        let selectedImgId = $('#category_image').val();

        $.ajax({
            method: 'GET',
            url: '/admin/media/images',
            success: (res) => {

                if(res.length > 0) {
                    $('#product-category-img-modal .modal-body').empty();

                    res.map(img => {
                        let imagesHtml = `
                            <div class="col-3 product-category-img-selectable">
                                <img src="/storage/${img.path}" alt="${img.name}" data-id="${img.id}">
                            </div>
                        `;

                        if(selectedImgId == img.id) {
                            imagesHtml = `
                                <div class="col-3 product-category-img-selectable">
                                    <img class="selected" src="/storage/${img.path}" alt="${img.name}" data-id="${img.id}">
                                </div>
                            `;
                        }

                        $('#product-category-img-modal .modal-body').append(imagesHtml)
                    })
                }

            },
            error: (err) => {
                console.log(err)
            }
        })
    })

    $(document).on('click', '.product-category-img-selectable', function(e){

        $('.product-category-img-selectable').each(function(i, el){
            if(e.currentTarget == el) {
                $(el).find('img').addClass('selected');
            } else {
                $(el).find('img').removeClass('selected');
            }
            
        }) 
    })

    $(document).on('click', '#set-product-main-image', () => { 
        $('#product-category-img-modal .product-category-img-selectable img').each(function(i, el){

            if($(el).hasClass('selected')){

                $('#category_image').val($(el).data('id'))
                $('#product-category-image-picker').empty().append(`
                    <img src=${$(el).attr('src')}>
                `)
            }

        }) 
    })
  });