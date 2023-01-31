 <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Gacetas Creadas</h6>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Numero de Gaceta</th>
                                            <th>Codigo de Sesion</th>
                                            <th>Fecha de Publicacion</th>
                                            <th style="width: 20%;"></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                    <?php
                                    foreach ($gacetas as $gaceta) {
                                        $codigoSesion = getSes($gaceta['sesiones_id']);
                                    ?>

                                        <tr>
                                            <td>
                                                <?php echo strtoupper($gaceta['numero']); ?>
                                            </td>
                                            <td>
                                                Sesion <?php echo $codigoSesion['tipo']." ".$codigoSesion['codigo']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $newDate = date("d-m-Y", strtotime($gaceta['fecha']));
                                                echo $newDate;
                                                ?>
                                            </td>
                                            <td class="text-center">

                                                <a href="pdf_gaceta.php?id=<?php echo $gaceta['id']; ?>" target="_blank" class="btn btn-success btn-circle btn-sm">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                <button type="button" class="btn btn-warning btn-circle btn-sm edit-gaceta"
                                                    data-sesion="<?php echo $gaceta['sesiones_id']; ?>"
                                                        data-fecha="<?php echo $gaceta['fecha']; ?>"
                                                        data-numero="<?php echo $gaceta['numero']; ?>"
                                                        data-id="<?php echo $gaceta['id'];?>">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-circle btn-sm elim-gac"
                                                        data-id="<?php echo $gaceta['id']; ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                                <form action="guardar.php" method="post" class="d-none"  id="form_eliminar_<?php echo $gaceta['id']; ?>">
                                                    <input type="text" name="opcion" value="eliminar" />
                                                    <input type="text" name="gacetas_id" value="<?php echo $gaceta['id']; ?>" />
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
