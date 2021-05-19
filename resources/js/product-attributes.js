$(() => {

    $(document).on('click', '#product-add-new-attribute', function(e) {
        e.preventDefault();
        
        let attributesWrapper = $('#product-attributes-wrapper');
        let attributesCount = attributesWrapper.find('.attribute').length;
        
        let attribute = `
            <div class="attribute">
                <div class="row">
                    <div class="col-5">
                        <div class="input-group input-group-sm mb-3 attr-key">
                            <input type="text" name="attr[${attributesCount}][key]" class="form-control attr-key">
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="input-group input-group-sm mb-3 attr-value">
                            <input type="text" name="attr[${attributesCount}][value]" class="form-control attr-value">
                        </div>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-danger btn-sm  product-del-attribute">X</button>
                    </div>
                </div>
            </div>
        `;

        attributesWrapper.append(attribute);
        
        return false;
    })

    $(document).on('click', '.product-del-attribute', function(e){
        e.preventDefault();

        $(e.target).closest('.attribute').remove();

        let attributesWrapper = $('#product-attributes-wrapper');
        let attributes = attributesWrapper.find('.attribute');

        attributes.each(function(i, el){

            let attrKey = $(el).find('.attr-key');
            let attrValue = $(el).find('.attr-value');
            let attrId = $(el).find('.attr-id'); 

            if(attrKey.length) {
                attrKey.attr('name', `attr[${i}][key]`);
            }
            if(attrValue.length) {
                attrValue.attr('name', `attr[${i}][value]`);
            }
            if(attrId.length) {
                attrId.attr('name', `attr[${i}][id]`);
            }
        })

    })
})
