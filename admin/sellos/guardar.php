<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
require "../flash_message.php";
$modulo = "sellos";

function guardarSello($path)
{
    $hoy = date("Y-m-d");
    $query = new Query();
    $sql = "INSERT INTO `sellos` (`path`) VALUES ('$path');";
    $row = $query->save($sql);
    return $row;
}

if (isset($_POST['subir'])) {
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
        - Se permiten archivos .gif, .jpg, .png. y de 800Kb como máximo.</b></div>';
            $alert = 'danger';
            crearFlashMessage($alert, $message, '../sellos/');
        }
        else {
            //ruta
            $path = '../../img/sellos/'.$archivo;
            //Si la imagen es correcta en tamaño y tipo
            //Se intenta subir al servidor
            if (move_uploaded_file($temp, $path)) {
                //guardo en base de datos la ruta
                guardarSello($path);
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                chmod($path, 0777);
                //Mostramos el mensaje de que se ha subido co éxito
                $message = '<div><b>Se ha subido correctamente la imagen.</b></div>';
                $alert = "success";
                crearFlashMessage($alert, $message, '../sellos/');
                //Mostramos la imagen subida
                /*echo '<p class="text-center"><img src="'.$path.'" class="img-thumbnail"></p>';*/
            }
            else {
                $message = '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                $alert = "danger";
                crearFlashMessage($alert, $message, '../sellos/');
            }
        }
    }
}

?>