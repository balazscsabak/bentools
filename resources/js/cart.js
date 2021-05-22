const { filter } = require("lodash");
import toast from 'siiimple-toast';

const Cart = function() {
    this.items = [];
    this.itemsList = [];

    this.init = () => {
        let items = JSON.parse(localStorage.getItem('cart'));

        if(!_.isEmpty(items)) {
            let initItems = items.map(item => {
                return item.name;
            })
            
            this.items = initItems;
            this.itemsList = items;
            
            this.renderCart();
        }
    }
    this.addToCart = (name, quantity, id) => {

        if(!this.items.includes(name)) {
            this.items.push(name);
            this.itemsList = [...this.itemsList, { name, quantity, id }]
        } else {
            this.itemsList = this.itemsList.map((item) => {
                if(item.name === name) {
                    return {
                        name,
                        quantity: item.quantity + quantity,
                        id
                    }
                } else {
                    return item;
                }
            })
        }

        this.updateStorageData();
        this.renderCart();
        toast.success('Termék hozzáadva az ajánlatkéréshez!', {
            container: 'body',
            class: 'siiimpleToast',
            position: 'top|center',
            margin: 70,
            delay: 0,
            duration: 200000,
        });
    };

    this.removeFromCart = (name) => {
        let checkIfContains = _.includes(this.items, name);
        
        if(checkIfContains) {
            
            let newItems = this.items.filter(item => {
                return item != name;
            })

            let newItemsList = this.itemsList.filter(item => {
                return item.name != name;
            })
            
            this.items = newItems;
            this.itemsList = newItemsList;
            
            this.updateStorageData();
            this.renderCart();
        } 
    }

    this.addEventListeners = () => {
        $(document).on('click', '.add-to-cart-btn', (e) => {
            let quantity = $(e.target).closest('.cart-action-add').find('input').val();
            let name = $(e.target).data('name');
            let id = $(e.target).data('id');
            this.addToCart(name, parseInt(quantity), id);
        })

        $(document).on('click', '.remove-from-cart-btn', (e) => {
            this.removeFromCart($(e.currentTarget).data('prod-name'));
        })

        
    };

    this.updateStorageData = () => {
        localStorage.setItem('cart', JSON.stringify(this.itemsList));
    }

    this.renderCart = () => {

        if($('#cart').length) {
            $('#cart .items').empty();

            for (const item of this.itemsList) {
                $('#cart .items').append(`
                    <div class="item row">
                        <div class="col-6 name" data-id="${item.id}">${item.name}</div>
                        <div class="col-5 quantity">${item.quantity}</div>
                        <div class="col-1 remove remove-from-cart-btn" data-prod-name="${item.name}"><i class="fas fa-times"></i></div>
                    </div>
                `)
            }
        }
    }
}

$(() => {
    const cart = new Cart();
    cart.init();
    cart.addEventListeners();
})