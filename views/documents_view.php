
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
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"><!--For icons-->
   <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('');?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php
            if($this->session->userdata('UserLoginSession'))
            {
                $udata=$this->session->userdata('UserLoginSession');
                
            }
            else{
                redirect(base_url('dashboard/login'));
                }
        ?>

<div class="container-fluid table-container mb-3">  
            <div class="col-md-12">
                <?php if (isset($success_message)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success_message; ?>
                </div>
                <?php endif; ?>

                <?php if($this->session->flashdata('error')){ ?>
                <p class="text-danger text-center"> <?=$this->session->flashdata('error') ?></p>
                <?php }?>

                <div class="card">
                    <div class="card-header">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                    <?php
                        foreach ($logo_data as $column1):
                        ?>
                        <h4 class="text-right text-<?= $column1['themecolor'] ?>">Upload Documents</h4>
                        <?php endforeach; ?>
                    
                    </div>
                    </div>
                    <div class="card-body">
                       
                    <?php echo form_open_multipart('dashboard/filesDocument');?>
                        <?php
                            if (isset($error)){
                                echo$this->session->flashdata('error');
                            }

                            echo$this->session->flashdata('success');

                        ?>
                        
                        <div class="col-md-6">
                                        <?php echo form_error('name'); ?>

                                        <label class="labels" for="name">Name:</label>
                                        <select name="name" id="name" class="form-control">
                                        <option value="">--- Choose a User ---</option>
                                        
                                        <?php if($employees):               
                                        foreach($employees as $row): 
                                        
                                            $chosenUser_id=$row->id;

                                        ?>
                                            <option value="<?php echo $chosenUser_id=$row->id; ?>" id="<?php echo $row->id; ?>"
                                            selected>
                                            <?php echo $row->name; ?>
                                            </option>


                                        <?php
                                        endforeach;?>
                                        <?php endif; ?>
                                        </select>

                                        </div>
                            
                            <br/><div class="col-md-6  mb-5">
                                <label class="labels">Choose Documents: </label><br><input type="file" name="userfiles[]"  multiple size="20" />
                                </div>
                            
                            <div class="col-md-12  mb-2">
                            <?php
                            foreach ($logo_data as $column1):
                            ?>
                            <a class="btn btn-<?= $column1['themecolor'] ?>"  href="<?php echo base_url('dashboard/documents');?>">Back</a>
                            <input type="submit"  class="btn btn-<?= $column1['themecolor'] ?> profile-button" name="fileSubmit" value="Upload">

                        <?php endforeach; ?>
                            
                            </div>

                                </div>
                            
                            <?php
                            if($this->session->flashdata('error')){ ?>
                            <p class="text-danger text-center"> <?=$this->session->flashdata('error') ?>
                            </p><?php }?>
                            <?php form_close(); ?>
                    
                    
                    </div>

                </div>
        
            </div>
        
        </div>        
    </div>




 <!-- Bootstrap core JavaScript-->
 <script src="<?php echo base_url('');?>assets/vendor/jquery/jquery.min.js"></script>
    <!-- <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('');?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('');?>assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url('');?>assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url('');?>assets/js/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url('');?>assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>
