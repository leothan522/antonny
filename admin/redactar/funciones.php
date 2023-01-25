<?php 
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
$modulo = "redactar";

$alert = null;
$message = null;


function getRedactar()
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `resoluciones` WHERE `band`= 1 ";
    $rows = $query->getAll($sql);
    return $rows;
}

?>