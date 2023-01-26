//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
});

//ELIMINAR
$(".elim-gac").click(function(e){

    e.preventDefault();
    //obtenemos los datos
    let id = this.dataset.id;

    //identificamos el formulario
    let form = document.getElementById("form_eliminar_" + id);

    //motramos la advertencia
    Swal.fire({
        title: '¿Estas seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!'
    }).then((result) => {
        //validamos que la respues sea si
        if (result.isConfirmed) {
            //mandamos a enviar el formulario
            form.submit();
        }
    });

});

// CAMBIAR FORMULARIO PARA EDITAR

$(".edit-gaceta").click(function(e){

    e.preventDefault();

    //mostramos un Loading
    Swal.fire({
        timer: 1000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
        },
    });

    //obtenemos los datos
    let sesion = this.dataset.sesion;
    let fecha = this.dataset.fecha;
    let numero = this.dataset.numero;
    let id = this.dataset.id;

    //identificamos los input
    let input_sesion = document.getElementById("input_sesion");
    let input_fecha = document.getElementById("input_fecha");
    let input_numero = document.getElementById("input_numero");
    let input_opcion = document.getElementById("input_opcion");
    let input_gacetas_id = document.getElementById("input_gacetas_id");
    let titulo = document.getElementById("titulo_form");



    //cambiamos el valor de los input y el titulo del CARDVIEW
    input_sesion.value = sesion;
    input_fecha.value = fecha;
    input_numero.value = numero;
    input_opcion.value = "editar";
    input_gacetas_id.value = id;
    titulo.innerText = "Editar Gaceta";

});

//CAMBIAR TITULO EN EL CARDVIEW
$("#btn_cancelar").click(function(e){
    let titulo = document.getElementById("titulo_form");
    titulo.innerText = "Crear Gaceta";
});
