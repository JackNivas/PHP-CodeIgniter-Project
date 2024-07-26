
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
                    <?php foreach ($logo_data as $column1):?>
                        <h4 class="text-right text-<?= $column1['themecolor'] ?>">Edit Documents</h4>
                    <?php endforeach; ?>
                    
                    </div>
                    </div>
                    <div class="card-body">
                       
                    <div class="row">
            
                    <div class="col-md-9">
                        <div class="p-3 py-5">
                        <?php echo form_open_multipart('dashboard/get_user_by_docs_update_id');?>
                        <?php
                            if (isset($error)){
                                echo$this->session->flashdata('error');
                            }

                            echo$this->session->flashdata('success');

                        ?>
                        
                        <div class="col-md-6 mb-2">
                                        <?php echo form_error('name'); ?>

                                        <label class="labels" for="name">Name:</label>
                                        <select name="name" id="name" class="form-control">
                                        <option value="<?php echo $docs_by_id->fileid; ?>"><?php echo $docs_by_id->username; ?></option>
                                    
                                        </select>

                        </div>
                            
                        <div class="col-md-6 mb-2">
                        <label class="labels">Document Name: </label><br/>
                        <span class="text-black-50"> <input type="text" class="form-control" value="<?php echo $docs_by_id->doc_name;?>"/></span>
                        </div>
                        <div class="col-md-6  mb-5">
                                <label class="labels">Choose Documents: </label><br><input type="file" name="userfiles[]"  multiple size="20" />
                                </div>
                            
                            <div class="col-md-12 mb-2">
                            
                            <?php
                            foreach ($logo_data as $column1):
                            ?>
                            <a class="btn btn-<?= $column1['themecolor'] ?>"  href="<?php echo base_url('dashboard/documents');?>">Back</a>
                            <input type="submit"  class="btn btn-<?= $column1['themecolor'] ?> profile-button" name="fileSubmit" value="Update">
                            

                        <?php endforeach; ?>
                            </div>

                                </div>
                            
                            <?php
                                                if($this->session->flashdata('error')){ ?>
                                                <p class="text-danger text-center"> <?=$this->session->flashdata('error') ?>
                                                </p><?php }?>
                                                <?php form_close(); ?>
                        </div>
                    <!-- <div class="col-md-4">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                            <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                            <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
                        </div>
                    </div> -->

                    
                </div>
            </div>
                    
                    
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
