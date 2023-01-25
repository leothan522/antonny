<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
$modulo = "asistentes";
$alert = null;
$usuario = null;


function getSesion($id)
{
    $row = null;
    $query = new Query();
    $sql = "SELECT * FROM `sesiones` WHERE `id` = '$id'";
    $row = $query->getFirst($sql);
    return $row;
}

if ($_GET) 
{
    if(!empty($_GET['id'])){
        $sesion_id = $_GET['id'];
        $sesion = getSesion($sesion_id);
    }
}

    //LISTAR USUARIOS
    function getAsistentes($id)
    {
        $query = new Query();
        $rows = null;
        $sql = "SELECT * FROM `asistencias` WHERE `sesiones_id` = '$id';";
        $rows = $query->getAll($sql);
        return $rows;
    }

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

function getSumario($sesiones_id, $asistencias_id)
{
    $row = null;
    $query = new Query();
    $sql1 = "SELECT * FROM `agendas` WHERE `sesiones_id` = '$sesiones_id' AND `asistencias_id` = '$asistencias_id'";
    $sumario = $query->getFirst($sql1);
    if ($sumario) {
        return $sumario['tema'];
    }else{
        return "";
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


            } else {
                $alert = "danger";
                $message = "error";
            }



        }else {
            $alert = "danger";
            $message = "faltan datos";
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
            } else {
                $alert = "warning";
                $message = "Error";
            }

        } else {
            $alert = "danger";
            $message = "faltan datos";
        }
    
    }


    if ($_POST['opcion'] == "eliminar") {

        if (!empty($_POST['asistencias_id'])){
    
            $id = $_POST['asistencias_id'];
    
            $asistentes = eliminarAsistentes($id);
    
            if ($asistentes) {
                $alert = "success";
                $message = "Asistente Eliminado";
            } else {
                $alert = "warning";
                $message = "Error";
            }
    
        } else {
            $alert = "danger";
            $message = "faltan datos";
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
            } else {
                $alert = "warning";
                $message = "Error";
            }


        }else{

        
        $alert = "danger";
        $message = "Faltan datos";


        }


        


    
    }

    

}



$asistentes = getAsistentes($sesion_id);

?>