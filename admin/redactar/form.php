<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" id="titulo_form">Redactar Resolucion</h6>
    </div>
    <div class="card-body">

    <form  method="POST" id="form_redactar">

        <div class="form-group">
            <label>Codigo</label>
            <input type="text" class="form-control" name="codigo" placeholder="Ingrese el Codigo" id="input_codigo" required />
        </div>

        <div class="form-group">
            <label>Fecha</label>
            <input type="date" class="form-control" name="fecha"id="input_fecha" required />

        </div>

        <div class="form-group">
            <label>Para</label>
            <input type="text" class="form-control" name="para" placeholder="Ingrese el Receptor"  id="input_para" required />

        </div>

        <div class="form-group">
            <label>De</label>
            <input type="text" class="form-control" name="de" placeholder=" Ingrese el Emisor"  id="input_de" required />

        </div>

        <div class="form-group">
            <label>Asunto</label>
            <input type="text" class="form-control" name="asunto" placeholder="Ingrese el Asunto"  id="input_asunto" required />

        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripcion</label>
            <textarea class="form-control" name="descripcion" id="input_descripcion" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label>C/C</label>
            <input type="text" class="form-control" name="cc" placeholder="Con Copia"  id="input_cc" required />

        </div>


        <input type="hidden" name="opcion" value="guardar" id="input_opcion" />
        <input type="hidden" name="redactar_id" id="input_redactar_id" />

        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="reset" class="btn btn-secondary float-right" id="btn_cancelar">Cancelar</button>

    </form>
        
    </div>
</div>