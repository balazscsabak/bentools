$('#registration-form').on('submit', function(e){
	const inputs = $(e.target).find('input');

	let valFlag = true;

	inputs.each((index, input) => {
		let inputValue = $(input).val();
		let inputName = $(input).attr('name');

		if(_.isEmpty(inputValue.trim())) {
			if($(`.${inputName}__input-error`).length < 1){
				$(input).after(`<div class="${inputName}__input-error text-danger mt-1">Hiányzó adat</div>`)
			}
			valFlag = false;
		} else {
			$(`.${inputName}__input-error`).remove();
		}
	})

	if(!valFlag){
		e.preventDefault();
	}
})