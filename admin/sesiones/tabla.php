 <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Seciones Creadas</h6>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Codigo</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                         
                                            <th style="width: 20%;"></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    
                                    <?php
                                    foreach ($sesiones as $sesion) {

                                    ?>

                                        <tr>
                                            <td>
                                                <?php echo $sesion['tipo']; ?>
                                            </td>
                                            <td>
                                                <?php echo $sesion['codigo']; ?> 
                                            </td>
                                            <td>
                                                <?php 
                                                $newDate = date("d-m-Y", strtotime($sesion['fecha']));
                                                echo $newDate; 
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                        echo date("g:i a", strtotime($sesion['hora']));
                                                ?>
                                            </td>
                                            <td class="text-center">

                                                <a href="../asistentes/index.php?id=<?php echo $sesion['id']; ?>" class="btn btn-primary btn-circle btn-sm">
                                                <i class="fas fa-list-alt"></i>
                                                </a>

                                                <button type="button" class="btn btn-warning btn-circle btn-sm edit-sesion"
                                                data-codigo="<?php echo $sesion['codigo']; ?>" data-fecha="<?php echo $sesion['fecha']; ?>" 
                                                data-tipo="<?php echo $sesion['tipo']; ?>" data-id="<?php echo $sesion['id']; ?>" data-hora="<?php echo $sesion['hora']; ?>" >
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-circle btn-sm elim-sesion"
                                                        data-id="<?php echo $sesion['id']; ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                                <form action="guardar.php" method="post" class="d-none"  id="form_eliminar_<?php echo $sesion['id']; ?>">
                                                    <input type="text" name="opcion" value="eliminar" />
                                                    <input type="text" name="sesiones_id" value="<?php echo $sesion['id']; ?>" />
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
