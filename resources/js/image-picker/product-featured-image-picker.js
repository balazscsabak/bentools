$(function () {

    $('#product-main-img-modal').on('show.bs.modal', function(e){
        let selectedImgId = $('#featured_image').val();

        $.ajax({
            method: 'GET',
            url: '/admin/media/images',
            success: (res) => {

                if(res.length > 0) {
                    $('#product-main-img-modal .modal-body').empty();

                    res.map(img => {
                        let imagesHtml = `
                            <div class="col-3 product-main-img-selectable">
                                <img src="/storage/${img.path}" alt="${img.name}" data-id="${img.id}">
                            </div>
                        `;

                        if(selectedImgId == img.id) {
                            imagesHtml = `
                                <div class="col-3 product-main-img-selectable">
                                    <img class="selected" src="/storage/${img.path}" alt="${img.name}" data-id="${img.id}">
                                </div>
                            `;
                        }

                        $('#product-main-img-modal .modal-body').append(imagesHtml)
                    })
                }

            },
            error: (err) => {
                console.log(err)
            }
        })
    })

    $(document).on('click', '.product-main-img-selectable', function(e){

        $('.product-main-img-selectable').each(function(i, el){
            if(e.currentTarget == el) {
                $(el).find('img').addClass('selected');
            } else {
                $(el).find('img').removeClass('selected');
            }
            
        }) 
    })

    $(document).on('click', '#set-product-main-image', () => { 
        $('#product-main-img-modal .product-main-img-selectable img').each(function(i, el){

            if($(el).hasClass('selected')){

                $('#featured_image').val($(el).data('id'))
                $('#product-main-image-picker').empty().append(`
                    <img src=${$(el).attr('src')}>
                `)
            }

        }) 
    })
  });