<?php
// start a session
session_start();
require "../seguridad.php";
require "../../mysql/Query.php";
$modulo = "blanco";



function getUsuarios()
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `users` WHERE `band`= 1 ";
    $rows = $query->getAll($sql);
    return $rows;
}

$usuarios = getUsuarios();

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GACETA - Firmantes</title>

    <!-- Custom fonts for this template-->
    <link href="../../plantilla/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../plantilla/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../plantilla/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            <?php require('../sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require('../topbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

            
               

                <div class="container-fluid">

                    <?php require "content.php" ?>

                </div>




                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php require('../footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../../plantilla/vendor/jquery/jquery.min.js"></script>
    <script src="../../plantilla/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../plantilla/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../plantilla/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../plantilla/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../plantilla/js/demo/chart-area-demo.js"></script>
    <script src="../../plantilla/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="../../plantilla/vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../plantilla/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../plantilla/js/demo/datatables-demo.js"></script>


</body>

</html>