<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
$modulo = "gacetas";
$alert = null;
$message = null;
$agendas = null;

function getSesiones()
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `sesiones`;";
    $rows = $query->getAll($sql);
    return $rows;
}

function getGacetas()
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `gacetas` WHERE `band` = 1;";
    $rows = $query->getAll($sql);
    return $rows;
}

function getSes($id)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `sesiones` WHERE `id` = $id;";
    $rows = $query->getFirst($sql);
    return $rows;
}


$sesiones = getSesiones();
$gacetas = getGacetas();

?>
