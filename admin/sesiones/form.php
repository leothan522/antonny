<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" id="titulo_form">Nueva Sesion</h6>
    </div>
    <div class="card-body">

    <form action="guardar.php"  method="POST" id="form_sesiones">

        <div class="form-group" >
            <label>Tipo de Sesión</label>
            <select class="form-control" name="tipo" id="input_tipo" required>
                <option value="">Seleccione</option>
                <option value="Ordinaria">Ordinaria</option>
                <option value="Extraordinaria">Extraordinaria</option>
            </select>
        </div>

        <div class="form-group">
            <label>Número</label>
            <input type="text" class="form-control" name="codigo" placeholder="ejemplo: AIS/004-2022" id="input_codigo">
        </div>

        <div class="form-group">
            <label>Fecha</label>
            <input type="date" class="form-control" name="fecha" id="input_fecha" required />
        </div>

        <div class="form-group">
            <label>Hora</label>
            <input type="time" class="form-control" name="hora" id="input_hora">
        </div>
        
        


        <input type="hidden" name="opcion" value="guardar" id="input_opcion" />
        <input type="hidden" name="sesiones_id" id="input_sesiones_id" />

        <button type="reset" class="btn btn-secondary" id="btn_cancelar">Cancelar</button>
        <button type="submit" class="btn btn-primary float-right">Guardar</button>

    </form>
        
    </div>
</div>