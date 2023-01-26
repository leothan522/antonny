<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" id="titulo_form">Agregar Asistente</h6>
    </div>
    <div class="card-body">

    <form  method="POST" id="form_asistencias">

    <div class="form-group" >
            <label>Tipo</label>
            <select class="form-control" name="invitado" id="input_invitado" required>
                <option value="">Seleccione</option>
                <option value="MIEMBROS">MIEMBROS</option>   
                <option value="DEPARTAMENTOS">DEPARTAMENTOS</option>
                <option value="COORDINACIONES">COORDINACIONES</option>
                <option value="INVITADOS">INVITADOS</option>

                               
               
            </select>
        </div>

    <div class="form-group">
            <label>Profesión</label>
            <input type="text" class="form-control" id="input_profesion" name="profesion" placeholder="Ingrese la Profesión">
        </div>

        <div class="form-group">
            <label>Nombre Completo</label>
            <input type="text" class="form-control" id="input_nombre" name="nombre" placeholder="Ingrese el Nombre y el Apellido">
        </div>

        <div class="form-group" >
            <label>Cargo</label>
            <select class="form-control" name="cargo" id="input_cargo" required>
                <option value="">Seleccione</option>
                <option value="Decano Presidente">Decano Presidente</option>
                <option value="Director de prograna de Ingenieía en Informática">Director de prograna de Ingenieía en Informática</option>
                <option value="Director del Programa de Estudios Básicos">Director del Programa de Estudios Básicos</option>
                <option value="Jefe del Departamento de Ciencias de la Computación">Jefe del Departamento de Ciencias de la Computación</option>
                <option value="Jefe del Departamento de Formación Profesional">Jefe del Departamento de Formación Profesional</option>
                <option value="Jefe del Departamento de Ciencias Básicas">Jefe del Departamento de Ciencias Básicas</option>
                <option value="Jefe del Departamento de Estudios Generales">Jefe del Departamento de Estudios Generales</option>
                <option value="Coordinador Académico">Coordinador Académico</option>
                <option value="Director del Centro de investigación y Estudios(CIES AIS)">Director del Centro de investigación y Estudios(CIES AIS)</option>
                <option value="Coordinador Administrativo">Coordinador Administrativo</option>
                <option value="Coordinador de Seguimiento y Control">Coordinador de Seguimiento y Control</option>
                <option value="Coordinador de la Comisión de Información y Comunicación">Coordinador de la Comisión de Información y Comunicación</option>
                <option value="Representante Profesoral">Representante Profesoral</option>
                <option value="Representante Estidiantil">Representante Estidiantil</option>
                <option value="Suplente">Suplente</option>
                <option value="No aplica">No aplica</option>
            </select>
        </div>


       

        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" class="form-control" id="input_telefono" name="telefono" placeholder="Ingrese el Teléfono si es un Invitado">
        </div>

        <input type="hidden" name="opcion" value="guardar" id="input_opcion" />
        <input type="hidden" name="asistentes_id" id="input_asistentes_id" />

        <button type="reset" class="btn btn-secondary" id="btn_cancelar">Cancelar</button>
        <button type="submit" class="btn btn-primary float-right">Guardar</button>

    </form>
        
    </div>
</div>