<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Resoluciones</h1>
    <a href="../redactar" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i>
        Crear Resoluciones
        
    </a>
</div>

<div class="row">

    <div class="col-md-12">

        <?php

        if($alert){
            ?>

            <div class="alert alert-<?php echo $alert; ?> alert-dismissible fade show" role="alert">
                <strong><?php echo $message; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php


        }

        ?>

    </div>
    
    <div class="col-md-12">
    <?php require "tabla.php"; ?>
    </div>

        
</div>



