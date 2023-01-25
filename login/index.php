<?php
// start a session
session_start();
require "../mysql/Query.php";
$condicion = false;
$message = null;
$alert = "warning";

if (isset($_SESSION['email'])) {
    header('location: ../admin/');
}


 function getLogin($email, $password){
   
    $query = new Query();
    $row = null;
    $sql = "SELECT * FROM `users` WHERE  `email` = '$email' AND `band`= 1 ;";
    $row = $query->getFirst($sql);

    if($row){
    
        if($row['password'] == $password){
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['band'] = $row['band'];
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
            $condicion = true;
            $alert = "danger";
            $message = "Contraseña Incorrecta";
        }

        if($resultado == "error_email"){
            $condicion = true;
            $alert = "warning";
            $message = "Email no encontrado";
        }

    }else{
        $condicion = true;
        $alert = "info";
        $message =  "Todos los campos son obligatorios";
    }

    

 }



?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="../plantilla/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../plantilla/css/sb-admin-2.css" rel="stylesheet">

</head>

<body style=" background: rgb(34,51,195);
background: linear-gradient(180deg, rgba(34,51,195,1) 65%, rgba(255,255,255,1) 100%); ">

    <?php require 'container.php'; ?>


    <!-- Bootstrap core JavaScript-->
    <!-- Bootstrap core JavaScript-->
    <script src="../plantilla/vendor/jquery/jquery.min.js"></script>
    <script src="../plantilla/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../plantilla/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../plantilla/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../plantilla/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../plantilla/js/demo/chart-area-demo.js"></script>
    <script src="../plantilla/js/demo/chart-pie-demo.js"></script>
</body>

</html>