<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" id="titulo_form">Crear Gaceta</h6>
    </div>
    <div class="card-body">

    <form action="guardar.php"  method="POST" id="form_gacetas">

        <div class="form-group">
            <label>Codigo de Sesion</label>
            <select class="form-control select2bs4" name="sesion_id" id="input_sesion" required>
                <option value="">Seleccione</option>
                <?php foreach ($sesiones as $sesion){ ?>
                    <option value="<?php echo $sesion['id'] ?>"><?php echo "Sesion ".$sesion['tipo']." ".$sesion['codigo'] ?></option>
                <?php  } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Fecha de Publicacion</label>
            <input type="date" class="form-control" name="fecha" id="input_fecha" required />
        </div>

        <div class="form-group">
            <label>Número de Gaceta</label>
            <input type="text" class="form-control" name="numero" placeholder="ejemplo: AIS/004-2022" id="input_numero" required>
        </div>
        


        <input type="hidden" name="opcion" value="guardar" id="input_opcion" />
        <input type="hidden" name="gacetas_id" id="input_gacetas_id" />

        <button type="reset" class="btn btn-secondary" id="btn_cancelar">Cancelar</button>
        <button type="submit" class="btn btn-primary float-right">Guardar</button>

    </form>
        
    </div>
</div>