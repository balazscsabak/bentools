function debounce(callback, wait) {
    let timeout;
    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            callback.apply(this, args);
        }, wait);
    };
}
function filterUpdateProductsOffer() {
    let filterName = $("#products-filter-name-offer").val();
    let filterCategory = $("#products-filter-category-offer").val();

    $.ajax({
        url: "/filter/products",
        method: "GET",
        data: {
            filterName,
            filterCategory,
        },
        beforeSend: () => {
            let spinner = `
                <div class="spinner-wrapper spinner-filter">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `;

            $(".offer .products table tbody").append(spinner);
        },
        success: (res) => {
            if (res.status) {
                let wrapper = $(".offer .products table tbody");
                let headerWrapper = $(".offer .products table thead");

                if (res.products.length > 0) {
                    wrapper.empty();
                    headerWrapper.empty();
                    headerWrapper.append(`
                        <tr>
                            <th scope="col">Termék név</th>
                            <th scope="col" >Mennyiség</th>
                        </tr>
                    `);
                    res.products.forEach((prod) => {
                        let prodHtml = `
                            <tr>
                                <td class="py-2">${prod.name}</td>
                                <td class="py-2">
                                    <div class="cart-action-add">
                                        <input type="number" min="1" max="200" value="1" >
                                        
                                        <div class="btn btn-primary btn-sm add-to-cart-btn ms-2" data-name="${prod.name}" data-id="${prod.id}">
                                            Hozzáad
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        `;

                        wrapper.append(prodHtml);

                    });
                } else {
                    wrapper.empty();
                    headerWrapper.empty();

                    let noContent = `
                        <td colspan="2" class="filter-no-content">
                            Nincs találat!
                        </td>
                    `;

                    wrapper.append(noContent);
                }
            }
        },
        complete: () => {},
        error: (err) => {
            console.log(err);
        },
    });
}
function filterUpdateProducts() {
    let filterName = $("#products-filter-name").val();
    let filterCategory = $("#products-filter-category").val();

    $.ajax({
        url: "/filter/products",
        method: "GET",
        data: {
            filterName,
            filterCategory,
        },
        beforeSend: () => {
            let spinner = `
                <div class="spinner-wrapper spinner-filter">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `;

            $(".products-wrapper").append(spinner);
        },
        success: (res) => {
            if (res.status) {
                if (res.products.length > 0) {
                    $(".products-wrapper").empty();

                    res.products.forEach((prod) => {
                        let prodHtml = `
                            <div class="col-3 related-item">
                                <a href="/product/${prod.slug}">
                                    <div class="image-wrapper">
                                        <div class="square image" style="background-image: url('/storage/${prod.featured_image.path}')"></div>
                                        <div class="blue-bg"></div>
                                    </div>
                            
                                    <div class="name">
                                        <h1>
                                            ${prod.name}
                                        </h1>
                                    </div>
                                    <div class="read-more">
                                        <span>Részletek <i class="fas fa-angle-double-right"></i></span>
                                    </div>
                                </a>
                            </div>
                        `;

                        $(".products-wrapper").append(prodHtml);
                    });
                } else {
                    $(".products-wrapper").empty();

                    let noContent = `
                        <div class="filter-no-content">
                            Nincs találat!
                        </div>
                    `;

                    $(".products-wrapper").append(noContent);
                }
            }
        },
        complete: () => {},
        error: (err) => {
            console.log(err);
        },
    });
}

$(() => {
    $(document).on('input', '#products-filter-name', debounce( filterUpdateProducts, 500));
    $(document).on('input', '#products-filter-name-offer', debounce( filterUpdateProductsOffer, 500));
    
    $(document).on("change", "#products-filter-category", filterUpdateProducts);
    $(document).on("change", "#products-filter-category-offer", filterUpdateProductsOffer);

    $(document).on('click', '.filter-reset--name', () => {
        $('#products-filter-name').val('');
        $('#products-filter-name').trigger('input');;
    })

    $(document).on('click', '.filter-reset--category', () => {
        $('#products-filter-category').val('1');
        $('#products-filter-category').trigger('change');;
    })

    $(document).on('click', '.filter-reset--name-offer', () => {
        $('#products-filter-name-offer').val('');
        $('#products-filter-name-offer').trigger('input');;
    })

    $(document).on('click', '.filter-reset--category-offer', () => {
        $('#products-filter-category-offer').val('1');
        $('#products-filter-category-offer').trigger('change');;
    })
});
