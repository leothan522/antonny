<div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                                    </div>
                                    <form  method="POST" class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="correo electrónico" name="email" value="<?php if(isset($_POST['email'])) { echo $_POST['email'];} ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="contraseña" name="password" required>
                                        </div>
                                       
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Login" />

                                        <div class="form-group mt-3">
                                          

                                            <?php if($condicion){ ?>


                                                <div class="alert alert-<?php echo $alert; ?> alert-dismissible fade show" role="alert">
                                                <strong><?php echo $message ?></strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>

                                            <?php } ?>


                                                
                                        </div>
                                
                                    
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="../web/">Volver al Inicio</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
