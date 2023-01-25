<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
$modulo = "firmantes";
$alert = null;
$usuario = null;



function getFirmantes()
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `firmantes` WHERE `band`= 1 ";
    $rows = $query->getAll($sql);
    return $rows;
}

function editarFirmantes($id, $nombre, $profesion, $cargo)
{
    $row = null;
    $query = new Query();
    $hoy = date("Y-m-d");
    $sql = "UPDATE `firmantes` SET `nombre`='$nombre', `profesion`='$profesion', `cargo`='$cargo', `update_at`='$hoy' WHERE `id`=$id;";
    $row = $query->save($sql);
    return $row;

}



function crearFirmantes($nombre, $profesion, $cargo, $path_firma = null)
{
    $row = null;
    $query = new Query();
    $hoy = date("Y-m-d");
    $sql = "INSERT INTO `firmantes` (`nombre`, `profesion`, `cargo`, `band`, `created_at`) VALUES ('$nombre', '$profesion', '$cargo', '1', '$hoy');";
    $row = $query->save($sql);
    return $row;

}

function eliminarFirmantes($id)
{
    $row = null;
    $query = new Query();
    $sql1 = "SELECT * FROM `firmantes` WHERE `id` = '$id'";
    $usuario = $query->getFirst($sql1);

    if ($usuario) {

        $hoy = date("Y-m-d");
        $sql = "UPDATE `firmantes` SET `band`='0', `update_at`='$hoy' WHERE  `id`=$id;";
        $row = $query->save($sql);
        return $row;

    } else {

        return false;

    }


}



if ($_POST) {

    //GUARDAR NUEVO USUARIO
    if ($_POST['opcion'] == "guardar") {

        if (!empty($_POST['nombre']) && !empty($_POST['profesion']) && !empty($_POST['cargo'])) {

            $nombre = $_POST['nombre'];
            $profesion = $_POST['profesion'];
            $cargo = $_POST['cargo'];

            $usuario = crearFirmantes($nombre, $profesion, $cargo,);

            
            if ($usuario) {


                $alert = "success";
                $message = "Firmante creado exitosimansansw";


            } else {
                $alert = "warning";
                $message = "error";
            }


        } else {
            $alert = "danger";
            $message = "faltan datos";
        }



    }

    if ($_POST['opcion'] == "editar") {
    
        if (!empty($_POST['firmantes_id']) && !empty($_POST['nombre']) && !empty($_POST['profesion']) && !empty($_POST['cargo'])) {

            $id = $_POST['firmantes_id'];
            $nombre = $_POST['nombre'];
            $profesion = $_POST['profesion'];
            $cargo = $_POST['cargo'];

            $usuario = editarFirmantes($id, $nombre, $profesion, $cargo);

            
            if ($usuario) {


                $alert = "success";
                $message = "Firmante creado exitosimansansw";


            } else {
                $alert = "warning";
                $message = "error";
            }


        } else {
            $alert = "danger";
            $message = "faltan datos";
        }


    
    }

    if ($_POST['opcion'] == "eliminar") {

        if (!empty($_POST['firmantes_id'])){
    
            $id = $_POST['firmantes_id'];
    
            $usuario = eliminarFirmantes($id);
    
            if ($usuario) {
                $alert = "success";
                $message = "Firmante Emilinado";
            } else {
                $alert = "warning";
                $message = "Error";
            }
    
        } else {
            $alert = "danger";
            $message = "faltan datos";
        }
    
    }

}



$usuarios = getfirmantes();


?>