$(() => {
    $(document).on('click', '#add-new-slide', function(e){
        e.preventDefault();

        let wrapper = $('#slideshow-wrapper');
        let slidesCount = wrapper.find('.slide').length;

        let content = `
            <div class="slide col-6">
                <div class="mb-3">
                    <label class="form-label">Cím</label>
                    <input type="text" class="form-control" name="slide[${slidesCount}][title]">
                </div>

                <div class="mb-3">
                    <label class="form-label">Szöveg</label>
                    <input type="text" class="form-control" name="slide[${slidesCount}][content]">
                </div>

                <div class="mb-3">
                    <label class="form-label">Gomb szöveg</label>
                    <input type="text" class="form-control" name="slide[${slidesCount}][link_text]">
                </div>

                <div class="mb-3">
                    <label class="form-label">Gomb link</label>
                    <input type="text" class="form-control" name="slide[${slidesCount}][link_href]">
                </div>

                <div class="mb-3 slide-img">
                    <label class="form-label">Háttérkép</label>
                    <button data-img-id class="btn btn-primary btn-sm open-slide-img-modal-btn" data-bs-toggle="modal" data-bs-target="#slide-image-picker-modal">Új kép</button>
                    <input class="hidden-img-id" type="hidden" name="slide[${slidesCount}][image]">
                    <img src="" alt="">
                </div>
            </div>
        `;

        wrapper.append(content);
    })
    
    $(document).on('click', '.open-slide-img-modal-btn', (e) => {
        e.preventDefault();
    })

    $('#slide-image-picker-modal').on('show.bs.modal', function(e){
        let selectedImgId = $(e.relatedTarget).data('img-id');
        let hiddenInput = $(e.relatedTarget).closest('.slide-img');

        $('#slide-image-picker-modal #set-slide-img-btn').data('element', hiddenInput);
 
        $.ajax({
            method: 'GET',
            url: '/admin/media/images',
            success: (res) => {

                if(res.length > 0) {
                    $('#slide-image-picker-modal .modal-body').empty();

                    res.map(img => {
                        let imagesHtml = `
                            <div class="col-3 slide-img-selectable">
                                <img src="/storage/${img.path}" alt="${img.name}" data-id="${img.id}">
                            </div>
                        `;

                        if(selectedImgId == img.id) {
                            imagesHtml = `
                                <div class="col-3 slide-img-selectable">
                                    <img class="selected" src="/storage/${img.path}" alt="${img.name}" data-id="${img.id}">
                                </div>
                            `;
                        }

                        $('#slide-image-picker-modal .modal-body').append(imagesHtml)
                    })
                }

            },
            error: (err) => {
                console.log(err)
            }
        })
    })

    $(document).on('click', '.slide-img-selectable', function(e){

        $('.slide-img-selectable').each(function(i, el){
            if(e.currentTarget == el) {
                $(el).find('img').addClass('selected');
            } else {
                $(el).find('img').removeClass('selected');
            }
            
        }) 
    })

    $(document).on('click', '#set-slide-img-btn', (e) => { 

        let hiddenInput = $(e.target).data('element').find('.hidden-img-id');
        let img = $(e.target).data('element').find('img');
        let button = $(e.target).data('element').find('button');

        $('#slide-image-picker-modal .slide-img-selectable img').each(function(i, el){

            if($(el).hasClass('selected')){

                hiddenInput.val($(el).data('id'))
                $('#product-main-image-picker').empty().append(`
                    <img src=${$(el).attr('src')}>
                `)
                img.attr('src', $(el).attr('src'));
                button.data('img-id', $(el).data('id'))
            }

        }) 
    })
})

