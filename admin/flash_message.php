<?php

function format_flash_message($alert, $message){

    $flas_message = '
        <div class="alert alert-'.$alert.' alert-dismissible fade show" role="alert">
            <strong>'.$message.'</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
    ';

    return $flas_message;

}


function display_flash_message()
{
    if (!isset($_SESSION['flash_message'])) {
        return;
    }

    $flash_alert = $_SESSION['flash_alert'];
    $flash_message = $_SESSION['flash_message'];

    unset($_SESSION['flash_alert']);
    unset($_SESSION['flash_message']);

    echo format_flash_message($flash_alert, $flash_message);
}

function crearFlashMessage($alert, $message, $url){
    $_SESSION['flash_alert'] = $alert;
    $_SESSION['flash_message'] = $message;
    header("Location: ".$url);
}



?>
