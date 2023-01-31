<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
$modulo = "sesiones";
$alert = null;
$message = null;

//LISTAR USUARIOS
function getSesiones()
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `sesiones` WHERE `band`= 1 ";
    $rows = $query->getAll($sql);
    return $rows;
}

$sesiones = getSesiones();

?>