<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
$modulo = "usuarios";

$alert = null;
$message = null;


//LISTAR USUARIOS
function getUsuarios()
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `users` WHERE `band`= 1 ";
    $rows = $query->getAll($sql);
    return $rows;
}

$usuarios = getUsuarios();

?>
