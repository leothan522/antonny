<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
$modulo = "sellos";

function guardarSello($path)
{
    $hoy = date("Y-m-d");
    $query = new Query();
    $sql = "INSERT INTO `sellos` (`path`) VALUES ('$path');";
    $row = $query->save($sql);
    return $row;
}

function getSello()
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `sellos` WHERE `band`= 1 ORDER BY `id` DESC";
    $rows = $query->getFirst($sql);
    return $rows;
}

$sello = getSello();

?>