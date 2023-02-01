function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            //$('#uploadForm + img').remove();
            document.getElementById('uploadForm').classList.add('d-none');
            $('#uploadForm').after('<p class="text-center"><img src="'+e.target.result+'" width="305" height="289"/></p>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#archivo").change(function () {
    filePreview(this);
});