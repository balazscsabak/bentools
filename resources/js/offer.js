$(() => {
	$(document).on('submit', '#offer-form', (e) => {
		e.preventDefault();
		let items = $('#cart .cart-items tbody tr');

		if(items.length) {
			items.each((i, item) => {
				let itemName = $(item).find('.name').text();
				let itemId = $(item).find('.delete-item-from-cart').data('id');
				let itemQuantity = $(item).find('.quantity').text().trim();
				itemQuantity = itemQuantity.substring(1, itemQuantity.length)
				itemQuantity = itemQuantity.substring(0, itemQuantity.length-7);

				let hiddenHtml = `
					<input type="hidden" name="items[${i}][name]" value="${itemName}"/>
					<input type="hidden" name="items[${i}][quantity]" value="${itemQuantity}"/>
					<input type="hidden" name="items[${i}][id]" value="${itemId}"/>
				`;

				$(e.target).append(hiddenHtml);
			})

			e.target.submit();
		}
	})
})