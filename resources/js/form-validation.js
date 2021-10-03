$('#registration-form').on('submit', function(e){
	e.preventDefault();

	const inputs = $(e.target).find('input');

	inputs.each((index, input) => {
		let inputValue = $(input).val();
		let inputName = $(input).attr('name');

		if(_.isEmpty(inputValue.trim())) {
			if($(`.${inputName}__input-error`).length < 1){
				$(input).after(`<div class="${inputName}__input-error text-danger mt-1">Hiányzó adat</div>`)
			}
		} else {
			$(`.${inputName}__input-error`).remove();
		}
	})
})