<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
require "../flash_message.php";
$modulo = "firma";
$usuario = null;

function guardarFirma($path, $id)
{
    $hoy = date("Y-m-d");
    $query = new Query();
    $sql = "UPDATE `firmantes` SET `path_firma`='$path', `update_at`='$hoy' WHERE  `id`=$id;";
    $row = $query->save($sql);
    return $row;
}

//Si se quiere subir una imagen
if (isset($_POST['subir'])) {
    $id = $_POST['firmante_id'];
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['archivo']['name'];
    //Si el archivo contiene algo y es diferente de vacio
    if (isset($archivo) && $archivo != "") {
        //Obtenemos algunos datos necesarios sobre el archivo
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 8000000))) {
            $message = '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
        - Se permiten archivos .gif, .jpg, .png. y de 800KB como máximo.</b></div>';
            $alert = 'danger';
            crearFlashMessage($alert, $message, '../firma/index.php?id='.$id);
        } else {
            //ruta
            $path = '../../img/firmas/'.$archivo;
            //Si la imagen es correcta en tamaño y tipo
            //Se intenta subir al servidor
            if (move_uploaded_file($temp, $path)) {
                //guardo en base de datos la ruta
                guardarFirma($path, $id);
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                chmod($path, 0777);
                //Mostramos el mensaje de que se ha subido co éxito
                $message = '<div><b>Se ha subido correctamente la imagen.</b></div>';
                $alert = "success";
                crearFlashMessage($alert, $message, '../firma/index.php?id='.$id);
                //Mostramos la imagen subida
                /*echo '<p class="text-center"><img src="'.$path.'" class="img-thumbnail"></p>';*/
            }
            else {
                //Si no se ha podido subir la imagen, mostramos un mensaje de error
                $message = '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                $alert = "danger";
                crearFlashMessage($alert, $message, '../firma/index.php?id='.$id);
            }
        }
    }


}



?>