<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-clipboard-list"></i> Resoluciones</h1>
    <?php if (validarSelloFirmante()){ ?>
        <a href="../redactar" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Crear Resoluciones
        </a>
    <?php }else{ ?>
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-download fa-sm text-white-50"></i>
        Crear Resoluciones
    </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p class="text-danger text-center">No se pueden crear resoluciones hasta que no se cargue <br>
                            <strong class="text-danger">el sello</strong> y se definan <strong class="text-danger">los firmantes</strong>,
                            <br> tanto el Presidente como el Secretario</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="row">

    <div class="col-md-12">

        <?php
            display_flash_message();
        ?>

    </div>
    
    <div class="col-md-12">
    <?php require "tabla.php"; ?>
    </div>

        
</div>



