
//VALIDAR CONTRASEÑA
$("#form_usuarios").submit(function (e) {

    e.preventDefault();
    let input_opcion = document.getElementById("input_opcion").value;
    let input_password = document.getElementById("input_password").value;
    let input_confirmar = document.getElementById("input_confirmar").value;

    // GUARDAR
    if (input_opcion === "guardar"){

        if (input_password.length === 0 || input_confirmar.length === 0){

             return Swal.fire({
                icon: 'error',
                text: 'Llena todos los campos de la contraseña'
            });

            //return alert("Llena todos los campos de la contraseña");

        }else {

            if (input_password === input_confirmar){
                this.submit();
            } else {

                return Swal.fire({
                    icon: 'warning',
                    text: 'Las contraseñas no coinciden.'
                });

                //return alert("Las contraseñas no coinciden.");
            }

        }

    }

    //EDITAR
    if (input_opcion === "editar"){

        if (input_password === input_confirmar){
            this.submit();
        } else {
            return Swal.fire({
                icon: 'warning',
                text: 'Las contraseñas no coinciden.'
            });
            //return alert("Las contraseñas no coinciden.");
        }

    }

});



// CAMBIAR FORMULARIO PARA EDITAR USUARIO

$(".edit-usu").click(function(e){

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
    let name = this.dataset.name;
    let email = this.dataset.email;
    let role = this.dataset.role;
    let id = this.dataset.id;

    //identificamos los input
    let input_name = document.getElementById("input_name");
    let input_email = document.getElementById("input_email");
    let input_role = document.getElementById("input_role");
    let input_opcion = document.getElementById("input_opcion");
    let input_user_id = document.getElementById("input_user_id");
    let titulo = document.getElementById("titulo_form");



    //cambiamos el valor de los input y el titulo del CARDVIEW
    input_name.value = name;
    input_email.value = email;
    input_role.value = role;
    input_user_id.value = id;
    input_opcion.value = "editar";
    titulo.innerText = "Editar Usuario";

});


//ELIMINAR USUARIO
$(".elim-usu").click(function(e){

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