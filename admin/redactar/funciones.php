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

function getSello()
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `sellos` WHERE `band` = 1 ORDER BY `id` DESC ;";
    $rows = $query->getFirst($sql);
    return $rows['id'];
}

function getFirmante($cargo)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `firmantes` WHERE `band` = 1 AND `cargo` = '$cargo' ORDER BY `id` DESC ;";
    $rows = $query->getFirst($sql);
    return $rows['id'];;
}

function crearDestinatario($profesion, $nombre, $cargo, $id)
{
    $row = null;
    $query = new Query();
    $hoy = date("Y-m-d");
    if ($id == -1){
        $sql = "INSERT INTO `destinatarios` (`profesion`, `nombre`, `cargo`) 
            VALUES ('$profesion', '$nombre', '$cargo');";
    }else{
        $sql = "UPDATE `destinatarios` SET `profesion`='$profesion', `nombre`='$nombre', `cargo`='$cargo' WHERE  `id`='$id';";
    }
    $row = $query->save($sql);
    return $row;
}

function crearResolucion($sesiones_id, $codigo, $profesion, $nombre, $cargo, $de, $fecha, $asunto, $descripcion, $cc, $destinatarios_id)
{
    $row = null;
    $sello_id = getSello();
    $presidente_id = getFirmante("Presidente");
    $secretario_id = getFirmante("Secretario");
    $query = new Query();
    $hoy = date("Y-m-d");

    if (!is_null($destinatarios_id)){
        crearDestinatario($profesion, $nombre, $cargo, $destinatarios_id);
    }

    $sql = "INSERT INTO `resoluciones` (`sesiones_id`, `codigo`, `profesion`, `nombre`, `cargo`, `de`, `fecha`, `asunto`, `descripcion`, `cc`, `sello_id`, `presidente_id`, `secretario_id`, `created_at`) 
            VALUES ('$sesiones_id', '$codigo', '$profesion', '$nombre', '$cargo', '$de', '$fecha', '$asunto', '$descripcion', '$cc', '$sello_id', '$presidente_id', '$secretario_id', '$hoy');";
    $row = $query->save($sql);
    return $row;
}

function editarResolucion($sesiones_id, $codigo, $profesion, $nombre, $cargo, $de, $fecha, $asunto, $descripcion, $cc, $id)
{
    $row = null;
    $query = new Query();
    $hoy = date("Y-m-d");

    $sql = "UPDATE `resoluciones` SET `sesiones_id`='$sesiones_id', `codigo`='$codigo', `profesion`='$profesion', `nombre`='$nombre', `cargo`='$cargo', `de`='$de', 
    `fecha`='$fecha', `asunto`='$asunto', `descripcion`='$descripcion', `cc`='$cc', `update_at`='$hoy' WHERE  `id`=$id;";
    $row = $query->save($sql);
    return $row;
}

function getResol($id)
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `resoluciones` WHERE `id` = $id;";
    $rows = $query->getFirst($sql);
    return $rows;
}

if ($_POST) {
    //GUARDAR NUEVO
    if ($_POST['opcion'] == "guardar") {

        /*$sesiones_id, $codigo, $profesion, $nombre, $cargo, $de, $fecha, $asunto, $descripcion, $cc*/

        if (!empty($_POST['sesion_id']) && !empty($_POST['codigo']) && !empty($_POST['profesion']) && !empty($_POST['nombre']
                && !empty($_POST['cargo']) && !empty($_POST['de']) && !empty($_POST['fecha']) && !empty($_POST['asunto'])
                && !empty($_POST['descripcion'])&& !empty($_POST['cc']))) {

            $sesiones_id = $_POST['sesion_id'];
            $codigo = $_POST['codigo'];
            $profesion = $_POST['profesion'];
            $nombre = $_POST['nombre'];
            $cargo = $_POST['cargo'];
            $de = $_POST['de'];
            $fecha = $_POST['fecha'];
            $asunto = $_POST['asunto'];
            $descripcion = $_POST['descripcion'];
            $cc = $_POST['cc'];
            if (isset($_POST['destinatarios_id'])){
                $destinatarios_id = $_POST['destinatarios_id'];
            }else{
                $destinatarios_id = null;
            }


            $resolucion = crearResolucion($sesiones_id, $codigo, $profesion, $nombre, $cargo, $de, $fecha, $asunto, $descripcion, $cc, $destinatarios_id);

            if($resolucion){

                $alert = "success";
                $message = "Guardado exitosimansansw";


            } else {
                $alert = "danger";
                $message = "error";
            }

        } else {

            $alert = "danger";
            $message = "faltan datos";

        }

    }

    //EDITAR
    if ($_POST['opcion'] == "editar") {

        /*$sesiones_id, $codigo, $profesion, $nombre, $cargo, $de, $fecha, $asunto, $descripcion, $cc*/

        if (!empty($_POST['sesion_id']) && !empty($_POST['codigo']) && !empty($_POST['profesion']) && !empty($_POST['nombre']
                && !empty($_POST['cargo']) && !empty($_POST['de']) && !empty($_POST['fecha']) && !empty($_POST['asunto'])
                && !empty($_POST['descripcion'])&& !empty($_POST['cc']))) {

            $sesiones_id = $_POST['sesion_id'];
            $codigo = $_POST['codigo'];
            $profesion = $_POST['profesion'];
            $nombre = $_POST['nombre'];
            $cargo = $_POST['cargo'];
            $de = $_POST['de'];
            $fecha = $_POST['fecha'];
            $asunto = $_POST['asunto'];
            $descripcion = $_POST['descripcion'];
            $cc = $_POST['cc'];
            $resoluciones_id = $_POST['resoluciones_id'];

            $resolucion = editarResolucion($sesiones_id, $codigo, $profesion, $nombre, $cargo, $de, $fecha, $asunto, $descripcion, $cc, $resoluciones_id);

            if($resolucion){

                $alert = "success";
                $message = "Guardado exitosimansansw";


            } else {
                $alert = "danger";
                $message = "error";
            }

        } else {

            $alert = "danger";
            $message = "faltan datos";

        }

    }
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