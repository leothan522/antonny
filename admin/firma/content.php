<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Firma</h1>
</div>

<div class="row">

    <div class="col-md-12">
        <?php display_flash_message(); ?>
    </div>

<div class="col-md-8">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Firma de <?php echo strtoupper($firmante['nombre']); ?></h6>
            </div>
            <div class="card-body">
                <?php require "imagen.php"; ?>
            </div>
        </div>


    </div>



    <div class="col-md-4">
        
        <div class="card shadow mb-4">
        
            <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Subir Firma</h6>
            </div>
            <div class="card-body">
                    <?php require "form.php"; ?>
            </div>

        </div>

    </div>
        
</div>



