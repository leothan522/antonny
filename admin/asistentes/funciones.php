<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
$modulo = "sesiones";
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

$asistentes = getAsistentes($sesion_id);

?>