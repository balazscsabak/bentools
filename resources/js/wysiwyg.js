import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

$(() => {

    if($('#post-content-editor').length) {
    
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
            // console.error(error);
        });
    }

    if($('#shipping-content-editor').length) {
    
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
            // console.error(error);
        });
    }

    if($('#about-us-content').length) {
    
        ClassicEditor.create(document.querySelector("#about-us-content"), {
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
            // console.error(error);
        });
    }

    $(".product-variant-content").each(function () {
        let id = $(this).attr('id');
        
        ClassicEditor.create(this, {
            ckfinder: {
                uploadUrl:
                    "/admin/media/upload-editor?_token=" +
                    $("[name='_token']").val(),
                openerMethod: "popup",
                withCredentials: true,
            },
        });
    });
});
