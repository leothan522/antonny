<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-file-alt"></i> Gacetas</h1>
    </div>

            <div class="row">
                <div class="col-md-12">

                    <?php
                        display_flash_message();
                    ?>

                </div>
    
                <div class="col-md-8">
                <?php require "tabla.php"; ?>
                </div>
                <div class="col-lg-4">
                <?php require "form.php"; ?>
                </div>

            </div>
    </div>


        
   
</div>



