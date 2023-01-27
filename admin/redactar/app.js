//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
});

$('#summernote').summernote({
    lang: 'es-ES' // default: 'en-US'
});

$("#destinatarios_id").change(function () {
    let estado = $("#destinatarios_id").val();
    let profesion;
    let nombre;
    let cargo;

    if (estado != "") {
        if (estado != -1) {
            let hidden = document.getElementById("data_" + estado);
            profesion = hidden.dataset.profesion;
            nombre = hidden.dataset.nombre;
            cargo = hidden.dataset.cargo;
        } else {
            profesion = null;
            nombre = null;
            cargo = null;
        }
    } else {
        profesion = null;
        nombre = null;
        cargo = null;
    }
    let input_profesion = document.getElementById("input_profesion");
    let input_nombre = document.getElementById("input_nombre");
    let input_cargo = document.getElementById("input_cargo");

    input_profesion.value = profesion;
    input_nombre.value = nombre;
    input_cargo.value = cargo;

});