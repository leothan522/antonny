 <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Asistencia al Consejo de Área Sesion 
                                <?php echo $sesion['tipo'] ?> Nro. <?php echo $sesion['codigo'] ?>
                                 de fecha <?php echo date("d-m-Y", strtotime($sesion['fecha'])) ?>
                            </h6>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Profesión</th>
                                            <th>cargo</th>
                                            <th>Telefono</th>
                                         
                                            <th style="width: 20%;"></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                    <?php
                                    foreach ($asistentes as $persona) {

                                        $verTema = getSumario($sesion_id, $persona['id'])

                                    ?>

                                       <tr>
                                            <td>
                                                <?php echo $persona['nombre_completo']; ?>
                                            </td>
                                            <td>
                                            <?php echo $persona['profesion']; ?>
                                            </td>
                                            <td>
                                            <?php echo $persona['cargo']; ?>
                                            </td>
                                            <td>
                                            <?php echo $persona['telefono']; ?>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-circle btn-sm edit-asistente" data-id="<?php echo $persona['id']; ?>"
                                                data-nombre="<?php echo $persona['nombre_completo']; ?>" data-profesion="<?php echo $persona['profesion']; ?>" 
                                                data-cargo="<?php echo $persona['cargo']; ?>" data-telefono="<?php echo $persona['telefono']; ?>"> 
                                                    <i class="fas fa-user-edit"></i> 
                                                </button>

                                                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-circle btn-sm edit-sumario" 
                                                data-id="<?php echo $persona['id']; ?>" data-agenda="<?php echo $verTema; ?>" >
                                                    <i class="far fa-comment-alt"></i>
                                                </button>

                                                <button type="button" class="btn btn-danger btn-circle btn-sm elim-asistente"
                                                        data-id="<?php echo $persona['id']; ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                                <form method="post" class="d-none"  id="form_eliminar_<?php echo $persona['id']; ?>">
                                                    <input type="text" name="opcion" value="eliminar" />
                                                    <input type="text" name="asistencias_id" value="<?php echo $persona['id']; ?>" />
                                                </form>
                                            </td>
                                            
                                       </tr>
                                       
                                       <?php
                                    }
                                        ?>
                                        
                                    </tbody>
                                   
                                </table>
                    
                            </div>
                        </div>
                        <div class="card-footer">
                        <a href="pdf_asistentes.php?id=<?php echo $sesion_id; ?>" class="btn btn-primary" target="_blank">Imprimir Asistentes</a>
                        <a href="pdf_agenda.php?id=<?php echo $sesion_id; ?>" class="btn btn-primary" target="_blank">Imprimir Agenda</a>
                        

<form  method="post">

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sumario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        


    

        <textarea name="tema" class="form-control" rows="1" cols="10" id="tema_sumario">
        </textarea>
       
        <input type="hidden" name="asistencias_id" id="sumario_asistentes">
        <input type="hidden" value="<?php echo $sesion_id; ?>" name="sesiones_id" id="sumario_sesiones">

   


      </div>
      <div class="modal-footer">
         <input type="hidden" name="opcion" value="sumario" />
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <input type="submit" class="btn btn-primary" value="Guardar" />
        

      </div>
    </div>
  </div>
</div>


</form>

                        </div>
                    </div>
                  
