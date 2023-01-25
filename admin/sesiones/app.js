// CAMBIAR FORMULARIO PARA EDITAR USUARIO

$(".edit-sesion").click(function(e){

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
    let codigo = this.dataset.codigo;
    let fecha = this.dataset.fecha;
    let tipo = this.dataset.tipo;
    let id = this.dataset.id;
    let hora = this.dataset.hora;

    //identificamos los input
    let input_tipo = document.getElementById("input_tipo");
    let input_codigo = document.getElementById("input_codigo");
    let input_fecha = document.getElementById("input_fecha");
    let input_hora = document.getElementById("input_hora");
    let input_opcion = document.getElementById("input_opcion");
    let input_sesiones_id = document.getElementById("input_sesiones_id");
    let titulo = document.getElementById("titulo_form");



    //cambiamos el valor de los input y el titulo del CARDVIEW
    input_tipo.value = tipo;
    input_codigo.value = codigo;
    input_fecha.value = fecha;
    input_hora.value = hora;
    input_opcion.value = "editar";
    input_sesiones_id.value = id;
    titulo.innerText = "Editar Sesion";

});


//ELIMINAR USUARIO
$(".elim-sesion").click(function(e){

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


//CAMBIAR TITULO EN EL CARDVIEW
$("#btn_cancelar").click(function(e){
    let titulo = document.getElementById("titulo_form");
    titulo.innerText = "Crear Sesion";
});

console.log('hi!');