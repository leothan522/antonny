<?php
// start a session
session_start();
require "Query.php";


 function getLogin($email, $password){
   
    $query = new Query();
    $row = null;
    $sql = "SELECT * FROM `users` WHERE  `email` = '$email';";
    $row = $query->getFirst($sql);

    if($row){
    
        if($row['password'] == $password){
            $_SESSION['name'] = $row['name'];
            return "redireccionar";
        }else{
            return "error_password";
        }

 }else{
    return "error_email";
 }

 }


 if($_POST){

    if($_POST['email'] && $_POST['password']){
        
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $resultado = getLogin($email, $pass);

        if($resultado == "redireccionar"){
            header('location: ../admin/index.php');
        }

        if($resultado == "error_password"){
            echo "contraseña incorrecta";
        }

        if($resultado == "error_email"){
            echo "Email no encontrado";
        }

    }else{
        echo "Todos los caqmpos son obligatorios";
    }

    

 }



?>