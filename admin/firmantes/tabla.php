 <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Usuarios Registrados</h6>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Profesion</th>
                                            <th>Cargo</th>
                                            <th style="width: 20%;"></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                        <?php 
                                            foreach($usuarios as $usuario){
                                        ?>

                                        <tr>
                                            <td>
                                                <?php echo $usuario['nombre']; ?>
                                            </td>
                                            <td>
                                                <?php echo $usuario['profesion']; ?>
                                            </td>
                                            <td>
                                            <?php echo $usuario['cargo']; ?>
                                            </td>
                                        
                                            <td class="text-center">
                                                
                                                <a href="../firma/index.php?id=<?php echo $usuario['id']; ?>" type="button" class="btn btn-info btn-circle btn-sm"
                                                        data-id="<?php echo $usuario['id']; ?>">
                                                    <i class="fas fa-image"></i>
                                                </a>

                                                <button type="button" class="btn btn-warning btn-circle btn-sm edit-firm"
                                                data-id="<?php echo $usuario['id']; ?>" data-nombre="<?php echo $usuario['nombre']; ?>"
                                                data-profesion="<?php echo $usuario['profesion']; ?>" data-cargo="<?php echo $usuario['cargo']; ?>" >
                                                    <i class="fas fa-user-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-circle btn-sm elim-Firm"
                                                        data-id="<?php echo $usuario['id']; ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                                <form action="guardar.php" method="post" class="d-none"  id="form_eliminar_<?php echo $usuario['id']; ?>">
                                                    <input type="text" name="opcion" value="eliminar" />
                                                    <input type="text" name="firmantes_id" value="<?php echo $usuario['id']; ?>" />
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
