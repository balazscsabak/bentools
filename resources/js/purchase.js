var stripe = Stripe(
    "pk_live_51Jgy78Fg1lMs6fEeEc7SMkMDhfmahn5KcKXMnxvCJgdEza8pPQdk1RqlIXtMGpQrdyogHlgcuaxLrm1oGddDG0EK00ijYV9SSG",
    {
        locale: "hu",
    }
);

const elements = stripe.elements();
const cardElement = elements.create("card", {
    hidePostalCode: true,
    style: {
        base: {
            fontWeight: "500",
            fontSize: "17px",
            padding: 10,
						backgroundColor: '#fff'
        },
    },
});

cardElement.mount("#card-element");

const cardHolderName = document.getElementById("card-holder-name");

const cardButtons = document.querySelectorAll(".card-button");

cardButtons.forEach((cardButton) => {
    cardButton.addEventListener("click", async (e) => {
        $(e.target).prop("disabled", true);

        let spinner = `
				<div class="spinner-wrapper spinner-filter spinner-wrapper--fixed" id="spinner-wrapper">
						<div class="spinner-border text-primary" role="status">
								<span class="visually-hidden">Loading...</span>
						</div>
				</div>
		`;

        $("body").append(spinner);

        let paymentMethodRadio = $(
            "#payment-menthod input[type='radio']:checked"
        ).val();

        let confirmCartSumm = _.toNumber($("#confirm_cart_summ").val());
        let userEmail = $("#email").val();

        let shippingPostcode = $("#shipping-postcode").val();
        let shippingCity = $("#shipping-city").val();
        let shippingStreet = $("#shipping-street").val();
        let shippingCounty = $("#shipping-county").val();

        let billingPostcode = $("#billing-postcode").val();
        let billingCity = $("#billing-city").val();
        let billingStreet = $("#billing-street").val();
        let billingCounty = $("#billing-county").val();

        let firmName = $("#firm-name").val();
        let taxNumber = $("#tax-number").val();
        let phonenumber = $("#phone-number").val();

        let billingShippingCheck = $("#billing-shipping-check");

        if (billingShippingCheck.is(":checked")) {
            billingPostcode = shippingPostcode;
            billingCity = shippingCity;
            billingStreet = shippingStreet;
            billingCounty = shippingCounty;
        }

        let formValidationCheck = true;

        if (_.isEmpty(phonenumber)) {
            if (
                $("#phone-number").closest("div").find(".val-error").length < 1
            ) {
                $("#phone-number").after(
                    `<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`
                );
            }
            formValidationCheck = false;
        } else {
            $("#phone-number").closest("div").find(".val-error").remove();
        }

        if (_.isEmpty(firmName)) {
            if ($("#firm-name").closest("div").find(".val-error").length < 1) {
                $("#firm-name").after(
                    `<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`
                );
            }
            formValidationCheck = false;
        } else {
            $("#firm-name").closest("div").find(".val-error").remove();
        }

        if (_.isEmpty(taxNumber)) {
            if ($("#tax-number").closest("div").find(".val-error").length < 1) {
                $("#tax-number").after(
                    `<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`
                );
            }
            formValidationCheck = false;
        } else {
            $("#tax-number").closest("div").find(".val-error").remove();
        }

        if (_.isEmpty(shippingPostcode)) {
            if (
                $("#shipping-postcode").closest("div").find(".val-error")
                    .length < 1
            ) {
                $("#shipping-postcode").after(
                    `<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`
                );
            }
            formValidationCheck = false;
        } else {
            $("#shipping-postcode").closest("div").find(".val-error").remove();
        }

        if (_.isEmpty(shippingCounty)) {
            if (
                $("#shipping-county").closest("div").find(".val-error").length <
                1
            ) {
                $("#shipping-county").after(
                    `<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`
                );
            }
            formValidationCheck = false;
        } else {
            $("#shipping-county").closest("div").find(".val-error").remove();
        }

        if (_.isEmpty(shippingCity)) {
            if (
                $("#shipping-city").closest("div").find(".val-error").length < 1
            ) {
                $("#shipping-city").after(
                    `<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`
                );
            }
            formValidationCheck = false;
        } else {
            $("#shipping-city").closest("div").find(".val-error").remove();
        }

        if (_.isEmpty(shippingStreet)) {
            if (
                $("#shipping-street").closest("div").find(".val-error").length <
                1
            ) {
                $("#shipping-street").after(
                    `<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`
                );
            }
            formValidationCheck = false;
        } else {
            $("#shipping-street").closest("div").find(".val-error").remove();
        }

        if (_.isEmpty(billingPostcode)) {
            if (
                $("#billing-postcode").closest("div").find(".val-error")
                    .length < 1
            ) {
                $("#billing-postcode").after(
                    `<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`
                );
            }
            formValidationCheck = false;
        } else {
            $("#billing-postcode").closest("div").find(".val-error").remove();
        }

        if (_.isEmpty(billingCounty)) {
            if (
                $("#billing-county").closest("div").find(".val-error").length <
                1
            ) {
                $("#billing-county").after(
                    `<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`
                );
            }
            formValidationCheck = false;
        } else {
            $("#billing-county").closest("div").find(".val-error").remove();
        }

        if (_.isEmpty(billingCity)) {
            if (
                $("#billing-city").closest("div").find(".val-error").length < 1
            ) {
                $("#billing-city").after(
                    `<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`
                );
            }
            formValidationCheck = false;
        } else {
            $("#billing-city").closest("div").find(".val-error").remove();
        }

        if (_.isEmpty(billingStreet)) {
            if (
                $("#billing-street").closest("div").find(".val-error").length <
                1
            ) {
                $("#billing-street").after(
                    `<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`
                );
            }
            formValidationCheck = false;
        } else {
            $("#billing-street").closest("div").find(".val-error").remove();
        }

        if (!formValidationCheck) {
            e.preventDefault();
            $("#spinner-wrapper").remove();
            $(e.target).prop("disabled", false);
            return false;
        }

        let gdprCheck = true;

        // TODO rename id
        if (paymentMethodRadio === "2") {
            // 30 napos
            $("#method-type-2 .gdpr-purchase-check").each((i, element) => {
                let isChecked = $(element).is(":checked");

                if (!isChecked) {
                    gdprCheck = false;

                    if (
                        $(element)
                            .closest(".form-check")
                            .find(".validation-error").length < 1
                    ) {
                        $(element)
                            .closest(".form-check")
                            .find(".form-check-label").after(`
							<div class="text-danger validation-error"><small>Mező elfogadása kötelező!</small></div>
						`);
                    }
                } else {
                    $(element)
                        .closest(".form-check")
                        .find(".validation-error")
                        .remove();
                }
            });
        } else if (paymentMethodRadio === "1") {
            // sima utalas
            $("#method-type-1 .gdpr-purchase-check").each((i, element) => {
                let isChecked = $(element).is(":checked");

                if (!isChecked) {
                    gdprCheck = false;

                    if (
                        $(element)
                            .closest(".form-check")
                            .find(".validation-error").length < 1
                    ) {
                        $(element)
                            .closest(".form-check")
                            .find(".form-check-label").after(`
							<div class="text-danger validation-error"><small>Mező elfogadása kötelező!</small></div>
						`);
                    }
                } else {
                    $(element)
                        .closest(".form-check")
                        .find(".validation-error")
                        .remove();
                }
            });
        } else {
            $("#card-info-placeholder .gdpr-purchase-check").each(
                (i, element) => {
                    let isChecked = $(element).is(":checked");

                    if (!isChecked) {
                        gdprCheck = false;

                        if (
                            $(element)
                                .closest(".form-check")
                                .find(".validation-error").length < 1
                        ) {
                            $(element)
                                .closest(".form-check")
                                .find(".form-check-label").after(`
						<div class="text-danger validation-error"><small>Mező elfogadása kötelező!</small></div>
					`);
                        }
                    } else {
                        $(element)
                            .closest(".form-check")
                            .find(".validation-error")
                            .remove();
                    }
                }
            );
        }

        if (!gdprCheck) {
            e.preventDefault();
            $("#spinner-wrapper").remove();
            $(e.target).prop("disabled", false);

            return false;
        }

        if (paymentMethodRadio === "3") {
            let cardHolderName = $("#card-holder-name").val();

            if (_.isEmpty(cardHolderName)) {
                $("#spinner-wrapper").remove();

                if (
                    $("#card-holder-name").closest("div").find(".val-error")
                        .length < 1
                ) {
                    $("#card-holder-name").after(
                        `<div class="val-error text-danger"><small>Mező kitöltése kötelező!</small></div>`
                    );
                }

                $(e.target).prop("disabled", false);
                e.preventDefault();
                return false;
            } else {
                $("#card-holder-name")
                    .closest("div")
                    .find(".val-error")
                    .remove();
            }

            // online card
            const { paymentMethod, error } = await stripe.createPaymentMethod(
                "card",
                cardElement,
                {
                    billing_details: {
                        name: cardHolderName,
                        email: userEmail,
                        phone: "+36 30 947 7500",
                        address: {
                            city: billingCity,
                            country: "HU",
                            line1: billingStreet,
                            postal_code: billingPostcode,
                            state: "Nógrád",
                        },
                    },
                }
            );

            if (error) {
                //validation error
                e.preventDefault();
                $("#spinner-wrapper").remove();
                $(e.target).prop("disabled", false);

                $("#card-element")
                    .closest(".card-element-wrapper")
                    .find(".val-error")
                    .remove();

                $("#card-element").after(
                    `<div class="val-error text-danger mb-1"><small>${error.message}</small></div>`
                );

                return false;
            } else {
                $.post(
                    "/purchase",
                    {
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
                        phonenumber,
                        shippingCounty,
                        billingCounty,
                    },
                    (res) => {
                        if (res.status) {
                            window.location = `/orders/${res.hash}`;
                        } else {
													// purchase error
													window.location = `/orders/error/${res.hash}`;
												}
                    }
                );
            }
        } else if (paymentMethodRadio === "2" || paymentMethodRadio === "1") {
            // transfer & delivery
            $.post(
                "/purchase",
                {
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
                    phonenumber,
                    shippingCounty,
                    billingCounty,
                },
                (res) => {
                    if (res.status) {
                        window.location = `/orders/${res.hash}`;
                    }
                }
            );
        }
    });
});
