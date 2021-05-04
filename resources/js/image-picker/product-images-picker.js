$(() => {

    $('#product-images-modal').on('show.bs.modal', function(e){
        let selectedImgId = $('#product_images').val();
        let selectedImgIds = _.split(selectedImgId, '~');

        console.log(selectedImgIds);

        $.ajax({
            method: 'GET',
            url: '/admin/media/images',
            success: (res) => {

                if(res.length > 0) {
                    $('#product-images-modal .modal-body').empty();

                    res.map(img => {
                        let imagesHtml = `
                            <div class="col-3 product-images-selectable">
                                <img src="/storage/${img.path}" alt="${img.name}" data-id="${img.id}">
                            </div>
                        `;

                        if(_.includes(selectedImgIds, img.id.toString())) {
                            imagesHtml = `
                                <div class="col-3 product-images-selectable">
                                    <img class="selected" src="/storage/${img.path}" alt="${img.name}" data-id="${img.id}">
                                </div>
                            `;
                        }

                        $('#product-images-modal .modal-body').append(imagesHtml)
                    })
                }

            },
            error: (err) => {
                console.log(err)
            }
        })
    });

    $(document).on('click', '.product-images-selectable', function(e){
        let target = $(e.target);
        target.toggleClass('selected');
    })

    $(document).on('click', '#set-product-images', () => { 

        let selectedIdsArray = [];

        $('#product-images-picker').empty();

        $('#product-images-modal .product-images-selectable img').each(function(i, el) {
            
            if($(el).hasClass('selected')){
                selectedIdsArray.push($(el).data('id'));
                $('#product-images-picker').append(`
                    <div class="col-3"><img src="${$(el).attr('src')}"></div>
                `)

            }
        })

        let selectedIds = _.join(selectedIdsArray, '~');

        $('#product_images').val(selectedIds);
    })

})