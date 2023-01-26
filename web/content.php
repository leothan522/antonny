<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-file-alt"></i> Gacetas</h1>
</div>

<div class="row">


<?php foreach ($gacetas as $gaceta) { ?>

    <div class="col-lg-4">
        <div class="card" style="width: 18rem;">
            <img src="../img/pdf.png" class="rounded mx-auto d-block mt-3"  width="20%" alt="...">
            <div class="card-body justify-content-center">
                <h5 class="card-title">Gaceta <?php echo strtoupper($gaceta['numero']); ?></h5>
                <p class="card-text">Fecha: <?php $newDate = date("d-m-Y", strtotime($gaceta['fecha'])); echo $newDate; ?></p>
                <a href="../admin/gacetas/pdf_gaceta.php?id=<?php echo $gaceta['id']; ?>" target="_blank" class="btn btn-primary">Descargar</a>
            </div>
        </div>
    </div>

<?php } ?>




</div>