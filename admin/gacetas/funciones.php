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

function exiteGaceta($sesion_id, $id = null)
{
    $query = new Query();
    $rows = null;
    if (is_null($id)){
        $sql = "SELECT * FROM `gacetas` WHERE `sesiones_id` = '$sesion_id' AND `band` = '1';";
    }else{
        $sql = "SELECT * FROM `gacetas` WHERE `sesiones_id` = '$sesion_id' AND `band` = '1' AND `id` != '$id';";
    }

    $rows = $query->getFirst($sql);
    return $rows;
}

//ELIMINAR
function eliminarGaceta($id)
{
    $row = null;
    $query = new Query();
    $hoy = date("Y-m-d");
    $sql = "UPDATE `gacetas` SET `band`='0' WHERE `id`='$id';";
    $row = $query->save($sql);
    return $row;
}

function getSes($id)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `sesiones` WHERE `id` = $id;";
    $rows = $query->getFirst($sql);
    return $rows;
}

//USUARIOS NUEVOS
function crearGaceta($sesiones_id, $fecha, $numero)
{
    $row = null;
    $query = new Query();
    $hoy = date("Y-m-d");
    $existe = exiteGaceta($sesiones_id);
    if ($existe){
        return false;
    }else{
        $sql = "INSERT INTO `gacetas` (`sesiones_id`, `fecha`, `numero`) VALUES ('$sesiones_id', '$fecha', '$numero');";
        $row = $query->save($sql);
        return $row;
    }

}

//USUARIOS NUEVOS
function editarGaceta($sesiones_id, $fecha, $numero, $id)
{
    $row = null;
    $query = new Query();
    $hoy = date("Y-m-d");
    $existe = exiteGaceta($sesiones_id, $id);
    if ($existe){
        return false;
    }else{
        $sql = "UPDATE `gacetas` SET `sesiones_id`='$sesiones_id', `fecha`='$fecha', `numero`='$numero' WHERE  `id`='$id';";
        $row = $query->save($sql);
        return $row;
    }

}

if ($_POST) {

//GUARDAR NUEVO USUARIO
    if ($_POST['opcion'] == "guardar") {


        if (!empty($_POST['sesion_id']) && !empty($_POST['fecha']) && !empty($_POST['numero'])) {

            $sesiones_id = $_POST['sesion_id'];
            $fecha = $_POST['fecha'];
            $numero = $_POST['numero'];

            $gaceta = crearGaceta($sesiones_id, $fecha, $numero);

            if($gaceta){
                $alert = "success";
                $message = "Asistente exitosimansansw";
            } else {
                $alert = "danger";
                $message = "Ya existe una gaceta creada con esa sesion. no se pueden repetir";
            }

        }else {
            $alert = "danger";
            $message = "faltan datos";
        }


    }

    //editar
    if ($_POST['opcion'] == "editar") {


        if (!empty($_POST['sesion_id']) && !empty($_POST['fecha']) && !empty($_POST['numero']) && !empty($_POST['gacetas_id'])) {

            $sesiones_id = $_POST['sesion_id'];
            $fecha = $_POST['fecha'];
            $numero = $_POST['numero'];
            $id = $_POST['gacetas_id'];

            $gaceta = editarGaceta($sesiones_id, $fecha, $numero, $id);

            if($gaceta){
                $alert = "success";
                $message = "Asistente exitosimansansw";
            } else {
                $alert = "danger";
                $message = "Ya existe una gaceta creada con esa sesion. no se pueden repetir";
            }

        }else {
            $alert = "danger";
            $message = "faltan datos";
        }


    }

    //ELIMINAR
    if ($_POST['opcion'] == "eliminar") {

        if (!empty($_POST['gacetas_id'])){

            $id = $_POST['gacetas_id'];

            $eliminar = eliminarGaceta($id);

            if ($eliminar) {
                $alert = "success";
                $message = "Emilinado";
            } else {
                $alert = "warning";
                $message = "Error";
            }

        } else {
            $alert = "danger";
            $message = "faltan datos";
        }

    }


}


$sesiones = getSesiones();
$gacetas = getGacetas();

?>
