<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
require "../flash_message.php";

//USUARIOS NUEVOS
function crearUsuario($name, $email, $password, $role)
{
    $row = null;
    $query = new Query();
    $sql1 = "SELECT * FROM `users` WHERE `email` = '$email'";
    $exite = $query->getFirst($sql1);

    if ($exite) {

        return false;

    } else {

        $hoy = date("Y-m-d");
        $sql = "INSERT INTO `users` (`email`, `password`, `name`, `created_at`) VALUES ('$email', '$password', '$name', '$hoy');";
        $row = $query->save($sql);
        return $row;

    }


}

//EDITAR USUARIOS
function editarUsuario($id, $name, $email, $password, $role)
{
    $row = null;
    $query = new Query();
    $sql1 = "SELECT * FROM `users` WHERE `id` = '$id'";
    $usuario = $query->getFirst($sql1);

    if ($usuario) {

        $sql2 = "SELECT * FROM `users` WHERE `email` = '$email' AND `id` != '$id'";
        $exite = $query->getFirst($sql2);

        if ($exite){

            return false;

        }else{

            $hoy = date("Y-m-d");
            if (!empty($password)){
                $sql = "UPDATE `users` SET `name`='$name', `email`='$email', `password`='$password', `role`='$role', `updated_at`='$hoy' WHERE  `id`=$id;";
            }else{
                $sql = "UPDATE `users` SET `name`='$name', `email`='$email', `role`='$role', `updated_at`='$hoy' WHERE  `id`=$id;";
            }
            $row = $query->save($sql);
            return $row;

        }



    } else {

        return false;

    }


}


//ELIMINAR USUARIOS
function eliminarUsuario($id)
{
    $row = null;
    $query = new Query();
    $sql1 = "SELECT * FROM `users` WHERE `id` = '$id'";
    $usuario = $query->getFirst($sql1);

    if ($usuario) {

        $hoy = date("Y-m-d");
        $sql = "UPDATE `users` SET `band`='0', `updated_at`='$hoy' WHERE  `id`=$id;";
        $row = $query->save($sql);
        return $row;

    } else {

        return false;

    }


}

if ($_POST) {
    //GUARDAR NUEVO USUARIO
    if ($_POST['opcion'] == "guardar") {

        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && isset($_POST['role'])) {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $usuario = crearUsuario($name, $email, $password, $role);

            if ($usuario) {

                $alert = "success";
                $message = "Usuario creado exitosimansansw";
                crearFlashMessage($alert,$message, '../usuarios/');


            } else {
                $alert = "warning";
                $message = "Email ya registrado";
                crearFlashMessage($alert, $message, '../usuarios/');
            }


        } else {
            $alert = "danger";
            $message = "faltan datos";
            crearFlashMessage($alert,$message, '../usuarios/');
        }

    }

    //EDITAR USUARIO
    if ($_POST['opcion'] == "editar") {

        if (!empty($_POST['users_id']) && !empty($_POST['name']) && !empty($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {


            $id = $_POST['users_id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $usuario = editarUsuario($id, $name, $email, $password, $role);

            if ($usuario) {
                $alert = "success";
                $message = "Cambios Guardados";
                crearFlashMessage($alert,$message, '../usuarios/');
            } else {

                $alert = "warning";
                $message = "Email ya registrado";
                crearFlashMessage($alert,$message, '../usuarios/');
            }

        } else {
            $alert = "danger";
            $message = "faltan datos";
            crearFlashMessage($alert,$message, '../usuarios/');
        }

    }

//ELIMINAR USUARIO
    if ($_POST['opcion'] == "eliminar") {

        if (!empty($_POST['users_id'])){

            $id = $_POST['users_id'];

            $usuario = eliminarUsuario($id);

            if ($usuario) {
                $alert = "success";
                $message = "Usuario Emilinado";
                crearFlashMessage($alert,$message, '../usuarios/');
            } else {
                $alert = "warning";
                $message = "Error";
                crearFlashMessage($alert,$message, '../usuarios/');
            }

        } else {
            $alert = "danger";
            $message = "faltan datos";
            crearFlashMessage($alert,$message, '../usuarios/');
        }

    }


}



?>