<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-clipboard-list"></i> Redactar Resolucion</h1>
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

            <?php require 'form.php' ?>
        </div>


        
   
</div>



