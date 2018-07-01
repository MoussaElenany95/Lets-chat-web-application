$(function () {

    $("#img").on("change",function (e) {
        readURL(this);
    });
});

function readURL(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {
            $('#preview-img').attr('src', e.target.result);
            $('#preview-img').show();
        };

       reader.readAsDataURL(input.files[0]);
    }
}