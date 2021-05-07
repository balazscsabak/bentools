const Cart = function() {
    this.items = [];
    this.itemsList = [];

    this.addToCart = (name, quantity) => {

        if(!this.items.includes(name)) {
            this.items.push(name);
            this.itemsList = [...this.itemsList, { name, quantity }]
        } else {
            this.itemsList = this.itemsList.map((item) => {
                if(item.name === name) {
                    return {
                        name,
                        quantity: item.quantity + quantity
                    }
                } else {
                    return item;
                }
            })
        }

        this.updateStorageData();
        this.renderCart();
    };

    this.addEventListenerss = () => {
        $(document).on('click', '.add-to-cart-btn', (e) => {
            let quantity = $(e.target).closest('.cart-action-add').find('input').val();
            let name = $(e.target).data('name');
            this.addToCart(name, parseInt(quantity));
        })

        $(document).on('updateCart', '.add-to-cart-btn', (e) => {
            console.log('custom event');
        })

        
    };

    this.updateStorageData = () => {
        localStorage.setItem('cart', JSON.stringify(this.itemsList));
    }

    this.renderCart = () => {
        
        console.log(JSON.parse(localStorage.getItem('cart')));

        if($('#cart').length) {
            $('#cart .items').empty();

            for (const item of this.itemsList) {
                $('#cart .items').append(`
                    <div class="item row">
                        <div class="col-6 name">${item.name}</div>
                        <div class="col-5 quantity">${item.quantity}</div>
                        <div class="col-1 remove"><i class="fas fa-times"></i></div>
                    </div>
                `)
            }
        }
    }
}

const updateCartEvent = new CustomEvent("updateCart", {
    detail: {},
    bubbles: true,
    cancelable: true,
    composed: false,
});

$(() => {
    const cart = new Cart();
    cart.addEventListenerss();
})