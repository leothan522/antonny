<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" id="titulo_form">Agregar Firmantes</h6>
    </div>
    <div class="card-body">

    <form action="guardar.php"  method="POST" id="form_firmantes">

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Ingrese nombre y apellido" id="input_nombre" required />
        </div>

        <div class="form-group">
            <label>Profesion</label>
            <input type="text" class="form-control" name="profesion" placeholder="Ingrese la profesion"  id="input_profesion" required />

        </div>


        <div class="form-group" >
            <label>Cargo</label>
            <select class="form-control" name="cargo" id="input_cargo" required>
                <option value="">Seleccione</option>
                <option value="Secretario">Secretario</option>
                <option value="Presidente">Presidente</option>
            </select>
        </div>
       

       

        <input type="hidden" name="opcion" value="guardar" id="input_opcion" />
        <input type="hidden" name="firmantes_id" id="input_firmantes_id" />

        <button type="reset" class="btn btn-secondary" id="btn_cancelar">Cancelar</button>
        <button type="submit" class="btn btn-primary float-right">Guardar</button>

    </form>
        
    </div>
</div>