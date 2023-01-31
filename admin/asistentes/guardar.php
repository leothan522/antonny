<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
require "../flash_message.php";
$modulo = "sesiones";
$alert = null;
$usuario = null;

function crearAsistente($sesiones_id, $profesion, $nombre, $cargo, $telefono, $invitado)
{
    $row = null;
    $query = new Query();
    $hoy = date("Y-m-d");
    $sql = "INSERT INTO `asistencias` (`sesiones_id`, `profesion`, `nombre_completo`, `cargo`, `telefono`, `invitado`) 
    VALUES ('$sesiones_id', '$profesion', '$nombre', '$cargo', '$telefono', '$invitado');";
    $row = $query->save($sql);
    return $row;
}


function crearSumario($sesiones_id, $asistencias_id, $tema)
{
    $row = null;
    $query = new Query();
    $sql1 = "SELECT * FROM `agendas` WHERE `sesiones_id` = '$sesiones_id' AND `asistencias_id` = '$asistencias_id'";
    $sumario = $query->getFirst($sql1);

    if($sumario){

        $id = $sumario['id'];
        $sql = "UPDATE `agendas` SET `tema` = '$tema' WHERE `id` = '$id';";
        $row = $query->save($sql);
        return $row;

    }else{

        $sql = "INSERT INTO `agendas` (`sesiones_id`, `asistencias_id`, `tema` ) VALUES ('$sesiones_id', '$asistencias_id', '$tema');";
        $row = $query->save($sql);
        return $row;

    }


}



//EDITAR USUARIOS
function editarAsistente($id, $profesion, $nombre, $cargo, $telefono, $invitado)
{
    $row = null;
    $query = new Query();
    $sql1 = "SELECT * FROM `asistencias` WHERE `id` = '$id'";
    $asistentes = $query->getFirst($sql1);

    if ($asistentes) {

        $hoy = date("Y-m-d");
        $sql = "UPDATE `asistencias` SET `profesion`='$profesion', `nombre_completo`='$nombre', `cargo`='$cargo', `telefono`='$telefono', `invitado`='$invitado' WHERE  `id`=$id;";
        $row = $query->save($sql);
        return $row;

    } else {

        return false;

    }

}

function eliminarAsistentes($id)
{
    $row = null;
    $query = new Query();
    $sql1 = "SELECT * FROM `asistencias` WHERE `id` = $id;";
    $asistentes = $query->getFirst($sql1);

    if ($asistentes) {


        $sql = "DELETE FROM `asistencias` WHERE  `id` = $id;";
        $row = $query->save($sql);
        return $row;

    } else {

        return false;

    }


}


if ($_POST) {
    $sesion_id = $_POST['sesion_id'];
    //GUARDAR NUEVO USUARIO
    if ($_POST['opcion'] == "guardar") {

        if (!empty($_POST['profesion']) && !empty($_POST['nombre']) && !empty($_POST['cargo']) && !empty($_POST['invitado'])) {

            $profesion = strtoupper($_POST['profesion']);
            $nombre = strtoupper($_POST['nombre']);
            $cargo = $_POST['cargo'];
            $invitado = $_POST['invitado'];
            $telefono = $_POST['telefono'];


            $asistentes = crearAsistente($sesion_id, $profesion, $nombre, $cargo, $telefono, $invitado);

            if($asistentes){

                $alert = "success";
                $message = "Asistente exitosimansansw";
                crearFlashMessage($alert, $message, '../asistentes/index.php?id='.$sesion_id);


            } else {
                $alert = "danger";
                $message = "error";
                crearFlashMessage($alert, $message, '../asistentes/index.php?id='.$sesion_id);
            }



        }else {
            $alert = "danger";
            $message = "faltan datos";
            crearFlashMessage($alert, $message, '../asistentes/index.php?id='.$sesion_id);
        }


    }




    //EDITAR
    if ($_POST['opcion'] == "editar") {

        if (!empty($_POST['profesion']) && !empty($_POST['nombre']) && !empty($_POST['cargo']) && !empty($_POST['invitado'])) {


            $profesion = $_POST['profesion'];
            $nombre = $_POST['nombre'];
            $cargo = $_POST['cargo'];
            $invitado = $_POST['invitado'];
            $telefono = $_POST['telefono'];
            $id = $_POST['asistentes_id'];

            $asistentes = editarAsistente($id, $profesion, $nombre, $cargo, $telefono, $invitado);

            if ($asistentes) {
                $alert = "success";
                $message = "Cambios Guardados";
                crearFlashMessage($alert, $message, '../asistentes/index.php?id='.$sesion_id);
            } else {
                $alert = "warning";
                $message = "Error";
                crearFlashMessage($alert, $message, '../asistentes/index.php?id='.$sesion_id);
            }

        } else {
            $alert = "danger";
            $message = "faltan datos";
            crearFlashMessage($alert, $message, '../asistentes/index.php?id='.$sesion_id);
        }

    }


    if ($_POST['opcion'] == "eliminar") {

        if (!empty($_POST['asistencias_id'])){

            $id = $_POST['asistencias_id'];

            $asistentes = eliminarAsistentes($id);

            if ($asistentes) {
                $alert = "success";
                $message = "Asistente Eliminado";
                crearFlashMessage($alert, $message, '../asistentes/index.php?id='.$sesion_id);
            } else {
                $alert = "warning";
                $message = "Error";
                crearFlashMessage($alert, $message, '../asistentes/index.php?id='.$sesion_id);
            }

        } else {
            $alert = "danger";
            $message = "faltan datos";
            crearFlashMessage($alert, $message, '../asistentes/index.php?id='.$sesion_id);
        }

    }

    if($_POST['opcion'] == "sumario"){


        $sesiones_id = $_POST['sesiones_id'];
        $asistencias_id = $_POST['asistencias_id'];
        $tema = $_POST['tema'];

        if (!empty($sesiones_id) && !empty($asistencias_id) && !empty($tema)) {


            $sumario = crearSumario($sesiones_id, $asistencias_id, $tema);

            if ($sumario) {
                $alert = "success";
                $message = "Sumario Creado";
                crearFlashMessage($alert, $message, '../asistentes/index.php?id='.$sesion_id);
            } else {
                $alert = "warning";
                $message = "Error";
                crearFlashMessage($alert, $message, '../asistentes/index.php?id='.$sesion_id);
            }


        }else{


            $alert = "danger";
            $message = "Faltan datos";
            crearFlashMessage($alert, $message, '../asistentes/index.php?id='.$sesion_id);


        }






    }



}


?>