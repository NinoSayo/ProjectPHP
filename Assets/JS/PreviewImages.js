     // Image preview function
     function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image-preview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#image-preview').hide();
        }
    }

    // Call the image preview function when an image is selected
    $('#input-image').change(function () {
        previewImage(this);
    });