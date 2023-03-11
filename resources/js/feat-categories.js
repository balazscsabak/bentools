$(() => {
    $(document).on("click", "#feat-cat-add-new-btn", function (e) {
        e.preventDefault();

        console.log($("#default-new-feat-items"));
        $("#feat-cat-form").append(
            $("#default-new-feat-items > .featured-cat-item").clone()
        );
    });

    $(document).on("click", ".feat-cat-delete-item", function (e) {
        e.preventDefault();

        $(e.target).closest(".featured-cat-item").remove();
    });

    $(document).on("submit", "#feat-cat-update-form", function (e) {
        const items = $("#feat-cat-form .featured-cat-item");

        const featCategories = [];

        items.each((i, item) => {
            featCategories.push({
                text: $(item).find(".fct-text").val(),
                img: $(item).find(".fct-img").val(),
                categories: $(item).find(".fct-categories").val(),
            });
        });

        const hiddenInput = $(
            `<input type="hidden" name="featuredCategories" value='${JSON.stringify(
                featCategories
            )}'>`
        );

        $("#feat-cat-update-form").append(hiddenInput);
    });
});
