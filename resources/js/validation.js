const validationNotNull = (e) => {
    let validation = true;

    $(".validate-not-null").each((index, el) => {
        if (_.isEmpty($(el).val().trim())) {
            $(el).css("border-color", "red");

            if ($(el).hasClass("validate-for-button")) {
                $(el).siblings("button").addClass("validation-error");
            }

            validation = false;
        } else {
            $(el).css("border-color", "#ced4da");

            if ($(el).hasClass("validate-for-button")) {
                $(el).siblings("button").removeClass("validation-error");
            }
        }
    });

    return validation;
};

export { validationNotNull };
