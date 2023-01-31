<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" id="titulo_form">Redactar Resolucion</h6>
    </div>
    <div class="card-body">

    <form action="guardar.php"  method="POST">

        <div class="form-group">
            <label>Codigo de Sesion</label>
            <select class="form-control select2bs4" name="sesion_id" required>
                <option value="">Seleccione</option>
                <?php foreach ($sesiones as $sesion){ ?>
                    <option <?php if ($resol_id && $get_resol['sesiones_id'] == $sesion['id']){ echo 'selected="selected"'; } ?> value="<?php echo $sesion['id'] ?>"><?php echo "Sesion ".$sesion['tipo']." ".$sesion['codigo'] ?></option>
                <?php  } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Codigo de Resolucion</label>
            <input type="text" class="form-control" name="codigo" placeholder="Ingrese el Codigo" id="input_codigo" value="<?php if ($resol_id){ echo $get_resol['codigo']; } ?>" required />
        </div>

        <div class="form-group">
            <label>Fecha</label>
            <input type="date" class="form-control" name="fecha" value="<?php if ($resol_id){ echo $get_resol['fecha']; } ?>" id="input_fecha" required />

        </div>

        <div class="form-group">
            <label>De</label>
            <input type="text" class="form-control" name="de" placeholder="Ingrese el Emisor" value="<?php if ($resol_id){ echo $get_resol['de']; } ?>"  id="input_de" required />

        </div>

        <div class="form-group">
            <label>Para</label>

            <?php if (!$resol_id) { ?>
                <select class="form-control select2bs4" name="destinatarios_id" id="destinatarios_id" required>
                    <option value="">Seleccione</option>
                    <option value="-1">NUEVO</option>
                    <?php foreach ($destinatarios as $destinatario){ ?>
                        <option value="<?php echo $destinatario['id'] ?>"><?php echo $destinatario['profesion']." ".$destinatario['nombre'] ?></option>
                    <?php  } ?>
                </select>
                <?php foreach ($destinatarios as $destinatario){ ?>
                    <input type="hidden" value="<?php echo $destinatario['profesion']." ".$destinatario['nombre'] ?>" id="data_<?php echo $destinatario['id'] ?>"
                           data-profesion="<?php echo $destinatario['profesion'] ?>" data-nombre="<?php echo $destinatario['nombre'] ?>" data-cargo="<?php echo $destinatario['cargo'] ?>" data-id="<?php echo $destinatario['id'] ?>">
                <?php  } ?>
            <?php } ?>

            <div class="row mt-3">
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="profesion" placeholder="Profesion" value="<?php if ($resol_id){ echo $get_resol['profesion']; } ?>"  id="input_profesion" required>
                </div>
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="input_nombre" value="<?php if ($resol_id){ echo $get_resol['nombre']; } ?>" required>
                </div>
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="cargo" placeholder="Cargo" id="input_cargo" value="<?php if ($resol_id){ echo $get_resol['cargo']; } ?>" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Asunto</label>
            <input type="text" class="form-control" name="asunto" placeholder="Ingrese el Asunto" value="<?php if ($resol_id){ echo $get_resol['asunto']; } ?>"  id="input_asunto" required />

        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripcion</label>
            <textarea class="form-control" name="descripcion" id="" cols="1" rows="3" required><?php if ($resol_id){ echo $get_resol['descripcion']; } ?></textarea>
        </div>

        <div class="form-group">
            <label>C/C</label>
            <textarea class="form-control" name="cc" cols="1" rows="2" placeholder="Con Copia" id="input_cc"><?php if ($resol_id){ echo $get_resol['cc']; } ?></textarea>

        </div>

        <input type="hidden" name="opcion" value="<?php if ($resol_id){ echo "editar"; }else{ echo "guardar"; } ?>" id="input_opcion" />
        <input type="hidden" name="resoluciones_id" value="<?php if ($resol_id){ echo $get_resol['id']; } ?>" id="input_redactar_id" />

        <a href="../resoluciones/" class="btn btn-secondary" id="btn_cancelar">Cancelar</a>
        <button type="submit" class="btn btn-primary float-right">Guardar</button>

    </form>
        
    </div>
</div>