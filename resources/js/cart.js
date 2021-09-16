import toast from "siiimple-toast";

// const Cart = function() {
//     this.items = [];
//     this.itemsList = [];

//     this.init = () => {
//         let items = JSON.parse(localStorage.getItem('cart'));

//         if(!_.isEmpty(items)) {
//             let initItems = items.map(item => {
//                 return item.name;
//             })

//             this.items = initItems;
//             this.itemsList = items;

//             this.renderCart();
//         }
//     }
//     this.addToCart = (name, quantity, id) => {

//         if(!this.items.includes(name)) {
//             this.items.push(name);
//             this.itemsList = [...this.itemsList, { name, quantity, id }]
//         } else {
//             this.itemsList = this.itemsList.map((item) => {
//                 if(item.name === name) {
//                     return {
//                         name,
//                         quantity: item.quantity + quantity,
//                         id
//                     }
//                 } else {
//                     return item;
//                 }
//             })
//         }

//         this.updateStorageData();
//         this.renderCart();
//         toast.success('Termék hozzáadva az ajánlatkéréshez!', {
//             container: 'body',
//             class: 'siiimpleToast',
//             position: 'top|center',
//             margin: 70,
//             delay: 0,
//             duration: 2000,
//         });
//     };

//     this.removeFromCart = (name) => {
//         let checkIfContains = _.includes(this.items, name);

//         if(checkIfContains) {

//             let newItems = this.items.filter(item => {
//                 return item != name;
//             })

//             let newItemsList = this.itemsList.filter(item => {
//                 return item.name != name;
//             })

//             this.items = newItems;
//             this.itemsList = newItemsList;

//             this.updateStorageData();
//             this.renderCart();
//         }
//     }

//     this.addEventListeners = () => {
//         $(document).on('click', '.add-to-cart-btn', (e) => {
//             let quantity = $(e.target).closest('.cart-action-add').find('input').val();
//             let name = $(e.target).data('name');
//             let id = $(e.target).data('id');
//             this.addToCart(name, parseInt(quantity), id);
//         })

//         $(document).on('click', '.remove-from-cart-btn', (e) => {
//             this.removeFromCart($(e.currentTarget).data('prod-name'));
//         })

//     };

//     this.updateStorageData = () => {
//         localStorage.setItem('cart', JSON.stringify(this.itemsList));
//     }

//     this.renderCart = () => {

//         if($('#cart').length) {
//             $('#cart .items').empty();

//             for (const item of this.itemsList) {
//                 $('#cart .items').append(`
//                     <div class="item row">
//                         <div class="col-6 name" data-id="${item.id}">${item.name}</div>
//                         <div class="col-5 quantity">${item.quantity}</div>
//                         <div class="col-1 remove remove-from-cart-btn" data-prod-name="${item.name}"><i class="fas fa-times"></i></div>
//                     </div>
//                 `)
//             }
//         }
//     }
// }

// $(() => {
//     const cart = new Cart();
//     cart.init();
//     cart.addEventListeners();
// })

const ShoppingCart = function () {
    this.name = "asdsa";

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

        $(document).on("click", "#test3", function (e) {
            e.preventDefault();

            $.post(
                "/cart/decrement",
                {
                    func: "getNameAndTime",
                },
                (res) => {
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
                $('#bank-transfver-placeholder').hide();
                $('#cash-on-delivery-placeholder').hide();
            } else if(selectedValue === "2") {
                $('#bank-transfver-placeholder').fadeIn('fast');
                $('#card-info-placeholder').hide();
                $('#cash-on-delivery-placeholder').hide();
            } else if(selectedValue === "1") {
                $('#cash-on-delivery-placeholder').fadeIn('fast');
                $('#card-info-placeholder').hide();
                $('#bank-transfver-placeholder').hide();
            }
        })
    };

    this.renderCart = () => {
        $.get("/cart/session", (res) => {
            if(res.status) {
                $('.cart-items').find('table tbody').empty();

                if(Object.keys(res.cart.items).length > 0) {
                    
                    Object.keys(res.cart.items).forEach(key => {
                        const item = res.cart.items[key]; 
                        console.log(item);
                        $('')
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
                                        <div class="quantity">
                                            <span class="multiply">x</span>${item.quantity} <span data-id="${item.variant_id}" class="delete delete-item-from-cart">Törlés</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="price fw-bold">
                                        ${item.quantity * item.price} .-
                                    </div>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    /**
                     * TODO
                     * empty kosar
                     */
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
