var stripe = Stripe('pk_test_51JOpB3FB0VHKdTU1X7yJGzXpVIeh2kVtjnrStxqjyIO9qKAPBo59nn89wXfA8VN4vfaNhWZXoDdSuz9B6vn5WKEX00c4ugPIv4',{
	locale: 'hu'
});

const elements = stripe.elements();
const cardElement = elements.create('card',{
	hidePostalCode: true,
	style: {
		base: {
			fontWeight: '500',
			fontSize: '17px',
			padding: 10,
		},
	},
});

// cardElement.mount('#card-element');

// const cardHolderName = document.getElementById('card-holder-name');
const cardButtons = document.querySelectorAll('.card-button');

cardButtons.forEach((cardButton) => {
	cardButton.addEventListener('click', async (e) => {
		$(e.target).prop('disabled', true);
		
		/**
		 * TODO validation, prevent double click
		 */

		let paymentMethodRadio = $("#payment-menthod input[type='radio']:checked").val();
	
		let confirmCartSumm = _.toNumber($('#confirm_cart_summ').val());
		let userEmail = $('#email').val();
	
		let shippingPostcode = $('#shipping-postcode').val();
		let shippingCity = $('#shipping-city').val();
		let shippingStreet = $('#shipping-street').val();
	
		let billingPostcode = $('#billing-postcode').val();
		let billingCity = $('#billing-city').val();
		let billingStreet = $('#billing-street').val();

		let firmName = $('#firm-name').val();
		let taxNumber = $('#tax-number').val();
		let phonenumber = $('#phone-number').val();
		
		let billingShippingCheck = $('#billing-shipping-check');
		
		if(billingShippingCheck.is(':checked')) {
			billingPostcode = shippingPostcode;
			billingCity = shippingCity;
			billingStreet = shippingStreet;
		}

		let fomrValidationCheck = true;

		if(_.isEmpty(phonenumber)){
			if($('#phone-number').closest('div').find('.val-error').length < 1) {
				$('#phone-number').after(`<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`)
			}
			fomrValidationCheck = false;
		} else {
			$('#phone-number').closest('div').find('.val-error').remove();
		}

		if(_.isEmpty(firmName)){
			if($('#firm-name').closest('div').find('.val-error').length < 1) {
				$('#firm-name').after(`<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`)
			}
			fomrValidationCheck = false;
		} else {
			$('#firm-name').closest('div').find('.val-error').remove();
		}

		if(_.isEmpty(taxNumber)){
			if($('#tax-number').closest('div').find('.val-error').length < 1) {
				$('#tax-number').after(`<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`)
			}
				fomrValidationCheck = false;
		} else {
			$('#tax-number').closest('div').find('.val-error').remove();
		}

		if(_.isEmpty(shippingPostcode)){
			if($('#shipping-postcode').closest('div').find('.val-error').length < 1) {
				$('#shipping-postcode').after(`<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`)
			}
				fomrValidationCheck = false;
		} else {
			$('#shipping-postcode').closest('div').find('.val-error').remove();
		}

		if(_.isEmpty(shippingCity)){
			if($('#shipping-city').closest('div').find('.val-error').length < 1) {
				$('#shipping-city').after(`<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`)
			}
				fomrValidationCheck = false;
		} else {
			$('#shipping-city').closest('div').find('.val-error').remove();
		}

		if(_.isEmpty(shippingStreet)){
			if($('#shipping-street').closest('div').find('.val-error').length < 1) {
				$('#shipping-street').after(`<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`)
			}
				fomrValidationCheck = false;
		} else {
			$('#shipping-street').closest('div').find('.val-error').remove();
		}

		if(_.isEmpty(billingPostcode)){
			if($('#billing-postcode').closest('div').find('.val-error').length < 1) {
				$('#billing-postcode').after(`<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`)
			}
				fomrValidationCheck = false;
		} else {
			$('#billing-postcode').closest('div').find('.val-error').remove();
		}

		if(_.isEmpty(billingCity)){
			if($('#billing-city').closest('div').find('.val-error').length < 1) {
				$('#billing-city').after(`<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`)
			}
				fomrValidationCheck = false;
		} else {
			$('#billing-city').closest('div').find('.val-error').remove();
		}
		
		if(_.isEmpty(billingStreet)) {
			if($('#billing-street').closest('div').find('.val-error').length < 1) {
				$('#billing-street').after(`<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`)
			}
				fomrValidationCheck = false;
		} else {
			$('#billing-street').closest('div').find('.val-error').remove();
		}

		if(!fomrValidationCheck) {
			e.preventDefault();
			$(e.target).prop('disabled', false);
			return false;
		}

		let gdprCheck = true;

		// TODO rename id
		if(paymentMethodRadio === '2'){
			$('#bank-transfver-placeholder .gdpr-purchase-check').each((i, element) => {
				let isChecked = $(element).is(":checked");
	
				if(!isChecked) {
					gdprCheck = false;
	
					if($(element).closest('.form-check').find('.validation-error').length < 1 ) {
						$(element).closest('.form-check').find('.form-check-label').after(`
							<div class="text-danger validation-error"><small>Mező elfogadása kötelező!</small></div>
						`);
					}
				} else {
					$(element).closest('.form-check').find('.validation-error').remove();
				}
			})
		} else if(paymentMethodRadio === '1') {
			$('#cash-on-delivery-placeholder .gdpr-purchase-check').each((i, element) => {
				let isChecked = $(element).is(":checked");
	
				if(!isChecked) {
					gdprCheck = false;
	
					if($(element).closest('.form-check').find('.validation-error').length < 1 ) {
						$(element).closest('.form-check').find('.form-check-label').after(`
							<div class="text-danger validation-error"><small>Mező elfogadása kötelező!</small></div>
						`);
					}
				} else {
					$(element).closest('.form-check').find('.validation-error').remove();
				}
			})
		}

		

		if(!gdprCheck) {
			e.preventDefault();
			$(e.target).prop('disabled', false);

			return false;
		}

		if(paymentMethodRadio === '3') {

			let cardHolderName = $('#card-holder-name').val();
	
			if(_.isEmpty(cardHolderName)) {
				console.log('empty');
				e.preventDefault();
				return false;
			}

			// online card
			const { paymentMethod, error } = await stripe.createPaymentMethod(
				'card', 
				cardElement, {
					billing_details: { 
						name: cardHolderName,
						email: userEmail,
						phone: '+36 30 947 7500',
						address: {
							city: billingCity,
							country: 'HU',
							line1: billingStreet,
							postal_code: billingPostcode,
							state: 'Nógrád'
						},
					}
				}
			);
		
			if (error) {
			} else {
				$.post('/purchase', {
					paymentMethodId: paymentMethod.id,
					shippingPostcode,
					shippingCity,
					shippingStreet,
					billingPostcode,
					billingCity,
					billingStreet,
					cardHolderName,
					userEmail,
					confirmCartSumm,
					method: paymentMethodRadio,
					firmName,
					taxNumber,
					phonenumber
				}, (res) => {
					if(res.status) {
						window.location = `/orders/${res.hash}`;
					}
				})
			}
		} else if( paymentMethodRadio === '2' || paymentMethodRadio === '1') {
			// transfer & delivery
			$.post('/purchase', {
				shippingPostcode,
				shippingCity,
				shippingStreet,
				billingPostcode,
				billingCity,
				billingStreet,
				userEmail,
				confirmCartSumm,
				method: paymentMethodRadio,
				firmName,
				taxNumber,
				phonenumber
			}, (res) => {
				if(res.status) {
					window.location = `/orders/${res.hash}`;
				}
			})
		} 
	});
})
