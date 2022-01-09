import toast from "siiimple-toast";

const ShoppingCart = function () {
    this.init = () => {
        this.setEventListeners();
        this.renderCart();
    };

    this.setEventListeners = () => {
        $(document).on("click", ".cart-toggler-menu, .cart-toggler", (e) => {
            $("#shopping-cart").toggleClass("show");
        });

        $(document).on("click", ".add-to-cart-btn", (e) => {
            e.preventDefault();
            let quantity = $(e.target).closest('.cart-action-add').find('input').val();
            let id = $(e.target).data('id');

            $.post(
                "/cart/add",
                {
                    quantity,
                    id
                },
                (res) => {
                    this.renderCart();
                    toast.success('Termék hozzáadva az kosárhoz!', {
                        container: 'body',
                        class: 'siiimpleToast',
                        position: 'top|center',
                        margin: 70,
                        delay: 0,
                        duration: 2000,
                    });
                }
            ).fail((err) => {
                console.log(err);
            });
        });

        $(document).on("click", ".delete-item-from-cart", (e) => {
            e.preventDefault();
            const id = $(e.target).data('id');

            $.post(
                "/cart/remove",
                {
                    id
                },
                (res) => {
                    if(res.status) {
                        this.renderCart();
                    }
                    console.log(res);
                }
            ).fail((err) => {
                console.log(err);
            });
        });

        $(document).on('change', '#billing-shipping-check', function(e) {
            if(this.checked) {
                $('#billing-address').fadeOut('fast');
            } else {
                $('#billing-address').fadeIn('fast');
            }
        })

        $(document).on('change', '.payment-method-radio', function(e) {
            const selectedValue = this.value;

            if(selectedValue === "3") {
                $('#card-info-placeholder').fadeIn('fast');
                $('#method-type-2').hide();
                $('#method-type-1').hide();
            } else if(selectedValue === "2") {
                $('#method-type-2').fadeIn('fast');
                $('#card-info-placeholder').hide();
                $('#method-type-1').hide();
            } else if(selectedValue === "1") {
                $('#method-type-1').fadeIn('fast');
                $('#card-info-placeholder').hide();
                $('#method-type-2').hide();
            }
        })

        $(document).on('change', '.unit-counter', function() {
            console.log('asd');
            const max = parseInt($(this).attr('max'));
            const min = parseInt($(this).attr('min'));
            const step = parseInt($(this).attr('step'));
            const val = $(this).val();

            if (val > max)
            {
                $(this).val(max);
            }
            else if (val < min)
            {
                $(this).val(min);
            } else if((val % step) !== 0) {
                const remainder = val % step;
                const roundedNumber = val - remainder;
                $(this).val(roundedNumber)
            } 
        })

        $(document).on('click', '.increment-item', (e) => {
            e.preventDefault();
            const id = $(e.target).data('id');
            
            $.ajax({
                method: 'POST',
                url: '/cart/increment',
                data: {
                    id
                },
                success: (res) => {
                    if(res.status) {
                        this.renderCart();
                    }
                },
                error: (err) => {
                    console.log(err);
                }
            })
        })

        $(document).on('click', '.decrement-item', (e) => {
            e.preventDefault();
            const id = $(e.target).data('id');

            $.ajax({
                method: 'POST',
                url: '/cart/decrement',
                data: {
                    id
                },
                success: (res) => {
                    if(res.status) {
                        this.renderCart();
                    }
                },
                error: (err) => {
                    console.log(err);
                }
            })
        })
    };

    this.renderCart = () => {
        $.get("/cart/session", (res) => {
            if(res.status) {
                $('.cart-items').find('table tbody').empty();

                if(Object.keys(res.cart.items).length > 0) {
                    let sum = 0;
                    let sumNet = 0;

                    Object.keys(res.cart.items).forEach(key => {
                        const item = res.cart.items[key]; 

                        sum += item.quantity * item.price;
                        sumNet += item.quantity * item.net_price;

                        console.log(item);
                        $('.cart-items').find('table tbody').append(`
                            <tr>
                                <th class="cart-td-image" scope="row">
                                    <div class="image" style="background-image: url(${item.image_href})"></div>
                                </th>
                                <td>
                                    <div class="item-info">
                                        <div class="name">
                                            ${item.name}
                                        </div>
                                        <div class="quantity mt-2 d-flex align-items-center">
                                            <span class="multiply">x</span>${item.quantity} 
                                            <div class="mx-3 d-flex flex-column align-items-center" style="font-size: 11px;">
                                                
                                                    <i class="fas fa-plus mb-1 increment-item" data-id="${item.variant_id}"></i>
                                                
                                                    <i class="fas fa-minus mt-1 decrement-item" data-id="${item.variant_id}"></i>
                                                
                                            </div>
                                            <span data-id="${item.variant_id}" class="delete delete-item-from-cart">Törlés</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="price fw-bold" style="white-space: nowrap;">
                                        ${item.quantity * item.price} .-
                                    </div>
                                </td>
                            </tr>
                        `);

                    });

                    $(".cart-page-sum").html(`<div>${sum} Ft</div><div class="fs-6 fw-light">Nettó: ${sumNet} Ft</div>`);
                    
                    
                } else {
                    /**
                     * TODO
                     * empty kosar
                     */
                    $(".cart-page-sum").html(`<div>0 Ft</div><div class="fs-6 fw-light">Nettó: 0 Ft</div>`);
                }
            }
        }).fail((err) => {
            console.log(err);
        });
    };
};

$(() => {
    const shoppingCart = new ShoppingCart();
    shoppingCart.init();
});
