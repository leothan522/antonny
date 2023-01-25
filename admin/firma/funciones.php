<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
$modulo = "firma";
$usuario = null;


function getUsuario($id)
{
    $row = null;
    $query = new Query();
    $sql = "SELECT * FROM `firmantes` WHERE `id` = '$id'";
    $row = $query->getFirst($sql);
    return $row;
}

if ($_GET) 
{
    if(!empty($_GET['id'])){
        $firmante_id = $_GET['id'];
        $firmante = getUsuario($firmante_id);
    }
}

function guardarFirma($path, $id)
{
    $hoy = date("Y-m-d");
    $query = new Query();
    $sql = "UPDATE `firmantes` SET `path_firma`='$path', `update_at`='$hoy' WHERE  `id`=$id;";
    $row = $query->save($sql);
    return $row;
}


?>