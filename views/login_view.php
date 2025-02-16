<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('');?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('');?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php
foreach ($logo_data as $column):
?>
    <body class="bg-gradient-<?= $column['themecolor'] ?>">
<?php endforeach; ?>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-9 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        
                                    <?php
                                    foreach ($logo_data as $column):
                                    ?>
                                    <h4 class="text-<?= $column['themecolor'] ?> mb-4">Welcome Back!</h4>
                                    <?php endforeach; ?>
                                    </div>
                                    <?php echo form_open('dashboard/loginnow'); ?>

                                    <!-- <form class="user"  method="post" action="dashboard/login"> -->
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                                <?php echo form_error('email'); ?>

                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                                <?php echo form_error('password'); ?>

                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="accept_terms"  class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>

                                            </div> -->
                                        <!-- </div> -->
                                        <?php
                                            foreach ($logo_data as $column):
                                            ?>
                                            <input type="submit"  class="btn btn-<?= $column['themecolor'] ?> btn-user btn-block" name="loginsubmit" value="Login">
                                            <?php endforeach; ?>
                                            
                                        <!-- <hr>
                                        
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    <!-- </form> -->
                                    <?php
                                    if($this->session->flashdata('error')){ ?>
                                    <p class="text-danger text-center"> <?=$this->session->flashdata('error') ?>
                                    </p><?php }?>
                                    <?php form_close(); ?>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url('Forgot');?>">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url('Register');?>">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                    <a href="<?php echo base_url('Glogin');?>" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>                                    
                                    </div>
                                    <div class="text-center">
                                    <a href="<?php echo base_url('dashboard/facebooksignin');?>" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook fa-fw"></i> Login with Facebook
                                        </a>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('');?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('');?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('');?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>