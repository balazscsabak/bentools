$(() => {
	$(document).on('submit', '#offer-form', (e) => {
		e.preventDefault();
		
		let items = $('#cart .items .item');

		if(items.length) {
			let itemsHtml = [];

			items.each((i, item) => {
				let itemName = $(item).find('.name').text();
				let itemId = $(item).find('.name').data('id');
				let itemQuantity = $(item).find('.quantity').text();

				let hiddenHtml = `
					<input type="hidden" name="items[${i}][name]" value="${itemName}"/>
					<input type="hidden" name="items[${i}][quantity]" value="${itemQuantity}"/>
					<input type="hidden" name="items[${i}][id]" value="${itemId}"/>
				`
				console.log(hiddenHtml);

				items.push(hiddenHtml);
				$(e.target).append(hiddenHtml);
				e.target.submit();
			})
		}
	})
})