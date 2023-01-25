$(".edit-firm").click(function(e){

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
    let nombre = this.dataset.nombre;
    let profesion = this.dataset.profesion;
    let cargo = this.dataset.cargo;
    let id = this.dataset.id;

    //identificamos los input
    let input_nombre = document.getElementById("input_nombre");
    let input_profesion  = document.getElementById("input_profesion");
    let input_cargo = document.getElementById("input_cargo");
    let input_opcion = document.getElementById("input_opcion");
    let input_firmantes_id = document.getElementById("input_firmantes_id");
    let titulo = document.getElementById("titulo_form");



    //cambiamos el valor de los input y el titulo del CARDVIEW
    input_nombre.value = nombre;
    input_profesion.value = profesion;
    input_cargo.value = cargo;
    input_firmantes_id.value = id;
    input_opcion.value = "editar";
    titulo.innerText = "Editar Usuario";

});

//ELIMINAR USUARIO
$(".elim-Firm").click(function(e){

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
    titulo.innerText = "Crear Usuario";
});

console.log('hi!');
