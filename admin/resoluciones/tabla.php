 <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Resoluciones Creadas</h6>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Codigo Resolucion</th>
                                            <th>Codigo Sesion</th>
                                            <th>Fecha</th>
                                            <th>Para</th>
                                            <th style="width: 20%;"></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                        <?php 
                                            foreach($resoluciones as $resolucion){

                                                $sesion = getSesion($resolucion['sesiones_id']);
                                        ?>

                                        <tr>
                                            <td>
                                                <?php echo $resolucion['codigo']; ?>
                                            </td>
                                            <td>
                                                <?php echo "Sesion ".$sesion['tipo']." ".$sesion['codigo']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $newDate = date("d-m-Y", strtotime($resolucion['fecha']));
                                                echo $newDate; ?>
                                            </td>
                                            <td>
                                                <?php echo $resolucion['nombre']; ?>
                                            </td>
                                            <td class="text-center">

                                                <a href="pdf_resolucion.php?id=<?php echo $resolucion['id']; ?>" target="_blank" class="btn btn-success btn-circle btn-sm">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                <a href="../redactar/index.php?id=<?php echo $resolucion['id']; ?>" class="btn btn-warning btn-circle btn-sm">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-circle btn-sm elim-res"
                                                        data-id="<?php echo $resolucion['id']; ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                                <form action="guardar.php" method="post" class="d-none"  id="form_eliminar_<?php echo $resolucion['id']; ?>">
                                                    <input type="text" name="opcion" value="eliminar" />
                                                    <input type="text" name="resoluciones_id" value="<?php echo $resolucion['id']; ?>" />
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
                    </div>
