import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

$(() => {
    ClassicEditor.create(document.querySelector("#post-content-editor"), {
        // toolbar: [ 'uploadImage'],
        ckfinder: {
            // Upload the images to the server using the CKFinder QuickUpload command.
            uploadUrl:
                "/admin/media/upload-editor?_token=" +
                $("[name='_token']").val(),
            openerMethod: "popup",
            // Enable the XMLHttpRequest.withCredentials property.
            withCredentials: true,

            headers: {
                // 'X-CSRF-TOKEN': "'" +  + "'"
            },
        },
    })
        .then((editor) => {
            //console.log( editor );
        })
        .catch((error) => {
            console.error(error);
        });

    ClassicEditor.create(document.querySelector("#shipping-content-editor"), {
        ckfinder: {
            uploadUrl:
                "/admin/media/upload-editor?_token=" +
                $("[name='_token']").val(),
            openerMethod: "popup",
            withCredentials: true,
        },
    })
        .then((editor) => {})
        .catch((error) => {
            console.error(error);
        });
});
