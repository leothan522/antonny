<?php 
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
$modulo = "resoluciones";

$alert = null;
$message = null;

function getSesiones()
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `sesiones`;";
    $rows = $query->getAll($sql);
    return $rows;
}

function getDestinatarios()
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `destinatarios`;";
    $rows = $query->getAll($sql);
    return $rows;
}


function getResol($id)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `resoluciones` WHERE `id` = $id;";
    $rows = $query->getFirst($sql);
    return $rows;
}

if ($_GET)
{
    if(!empty($_GET['id'])){
        $resol_id = $_GET['id'];
        $get_resol = getResol($resol_id);
    }else{
        $resol_id = false;
    }
}else{
    $resol_id = false;
}

$sesiones = getSesiones();
$destinatarios = getDestinatarios();

?>