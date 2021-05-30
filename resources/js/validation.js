const validationNotNull = (e) => {
	let validation = true;
	
	$('.validate-not-null').each((index, el) => {

		if(!$(el).val()) {
			$(el).css('border-color', 'red');
			validation = false;
		} else {
			$(el).css('border-color', '#ced4da');
		}

	})

	return validation;
}

export {
	validationNotNull
} 
	

