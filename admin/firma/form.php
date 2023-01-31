<form action="guardar.php"  method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label>Añadir imagen</label>
        <!--<input class="form-control" name="archivo" id="archivo" type="file"/>-->
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="archivo" lang="es" name="archivo">
            <label class="custom-file-label" for="archivo">Seleccionar Archivo</label>
        </div>
    </div>

    <input type="hidden" name="firmante_id" value="<?php echo $firmante_id; ?>">


    <a href="../firmantes/" class="btn btn-secondary ">Cancelar</a>
    <button type="submit" name="subir" class="btn btn-primary float-right">Subir</button>


</form>