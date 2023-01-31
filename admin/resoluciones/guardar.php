<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
require "../flash_message.php";
$modulo = "resoluciones";
$alert = null;
$message = null;

//ELIMINAR
function eliminarResolucion($id)
{
    $row = null;
    $query = new Query();
    $hoy = date("Y-m-d");
    $sql = "UPDATE `resoluciones` SET `band`='0', `update_at`='$hoy' WHERE `id`='$id';";
    $row = $query->save($sql);
    return $row;
}

if ($_POST) {

    //ELIMINAR
    if ($_POST['opcion'] == "eliminar") {

        if (!empty($_POST['resoluciones_id'])){

            $id = $_POST['resoluciones_id'];

            $eliminar = eliminarResolucion($id);

            if ($eliminar) {
                $alert = "success";
                $message = "Emilinado";
                crearFlashMessage($alert, $message, '../resoluciones/');
            } else {
                $alert = "warning";
                $message = "Error";
                crearFlashMessage($alert, $message, '../resoluciones/');
            }

        } else {
            $alert = "danger";
            $message = "faltan datos";
            crearFlashMessage($alert, $message, '../resoluciones/');
        }

    }

}



?>