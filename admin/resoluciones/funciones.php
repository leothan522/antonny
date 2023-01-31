<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
$modulo = "resoluciones";
$alert = null;
$message = null;

function getResoluciones()
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `resoluciones` WHERE `band`= 1; ";
    $rows = $query->getAll($sql);
    return $rows;
}

function getSesion($id)
{
    $row = null;
    $query = new Query();
    $sql = "SELECT * FROM `sesiones` WHERE `id` = '$id'";
    $row = $query->getFirst($sql);
    return $row;
}

function getFirmante($cargo)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `firmantes` WHERE `band` = 1 AND `cargo` = '$cargo' ORDER BY `id` DESC ;";
    $rows = $query->getFirst($sql);
    return $rows;
}

function validarSelloFirmante()
{
    $query = new Query();
    $rows = null;
    $presidente_id = getFirmante("Presidente");
    $secretario_id = getFirmante("Secretario");
    $sqlSello = "SELECT * FROM `sellos` WHERE `band` = 1;";
    $sello = $query->getFirst($sqlSello);
    if ($sello && $presidente_id && $secretario_id){
        return true;
    }else{
        return false;
    }

}

$resoluciones = getResoluciones();

?>