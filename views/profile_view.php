
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

<div class="container rounded bg-white mt-5 mb-5">
    

        </div>
<!-- </div> -->

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
                    <div class="d-flex justify-content-center align-items-center">
                    <?php
                    foreach ($logo_data as $column1):
                    ?>    
                    <h4 class="text-right text-<?= $column1['themecolor'] ?>">Profile Settings</h4>
                    <?php endforeach; ?>
                    
                    </div>
                    </div>
                    <div class="card-body">
                       
                    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <?php if($profiles->profpic==" ") { ?>
                <img class="img-profile rounded-circle" style="border: gray 2px solid;" src="<?php echo base_url('uploads/default.jpg'); ?>">

                    <?php } else{?>
                        <img class="rounded-circle mt-5" width="150px" src="<?php echo base_url('uploads/'.$profiles->profpic); ?>">
                <?php }?>
                <span class="font-weight-bold"><?php echo $profiles->name; ?></span>
                <span class="text-black-50"><?php echo $profiles->email; ?></span><span> </span>

                <?php 
                $date= new DateTime($udata['datecreateon']);
                
                ?>
                <span class="text-black-50">Date of Join: <?php echo $date->format('j-M-Y'); ?></span>
                <span class="text-black-50">Role: <?php echo $udata['role']; ?></span>

            </div>
        </div>
        <div class="col-md-9">
            <div class="p-3 py-5">
                
                <div class="row mt-3">
                    <div class="col-md-12 mb-2">
                        <label class="labels">Name:</label><span class="text-black-50"> <?php echo $profiles->name; ?></span>
                    </div>
                    <?php echo form_error('name'); ?>

                    <div class="col-md-12  mb-2">
                        <label class="labels">Contact: </label><span class="text-black-50"> <?php echo $profiles->mobile; ?></span>
                    </div>
                    <?php echo form_error('mobile'); ?>

                    <div class="col-md-12  mb-2">
                        <label class="labels">Address:</label><span class="text-black-50"> <?php echo $profiles->address; ?></span>
                    </div>
                    <?php echo form_error('address'); ?>
                    
                    
                    <div class="col-md-12  mb-2">
                        <label class="labels">Email:</label><span class="text-black-50"> <?php echo $profiles->email; ?></span>
                    </div>
                    <?php echo form_error('email'); ?>

                    <div class="col-md-12  mb-2">
                        <label class="labels">Qualification:</label><span class="text-black-50"> <?php echo $profiles->education; ?></span>
                    </div>
                    <?php echo form_error('eduation'); ?>
                    </div>
                
                    <div class="mt-5 text-center">
                    <?php
                    foreach ($logo_data as $column1):
                    ?>
                    <a href="<?php echo base_url('ProfileShow');?>"  class="btn btn-<?= $column1['themecolor'] ?> profile-button mb-2">Edit Profile</a></br>
                    <form action="<?php echo base_url('dashboard/remove_prof_pic'); ?>" id="frm_filters" method="post" name="frm_filters">
                    <input type="hidden" id="id_data" name="product_id" value="<?php echo $profiles->id;?>" />

                    <button type="submit" onclick="confirmDelete()" class="btn btn-<?= $column1['themecolor'] ?> profile-button">Remove Profile Pic</button>
                    </form>
                    <?php endforeach; ?>
                    </div>
                    <!-- <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?=base_url('dashboard/logout')?>">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                     -->
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
        
        </div>        
    </div>

 <!-- Bootstrap core JavaScript-->
 <script src="<?php echo base_url('');?>assets/vendor/jquery/jquery.min.js"></script>
 <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

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
<script>
// JavaScript function to handle confirmation
function confirmDelete() {
    // Display a confirmation dialog
    var result = confirm("Are you sure you want to remove the profile picture?");

    // If the user clicks "OK," proceed with the deletion
    if (result) {
        // Redirect to the controller function to remove the profile picture
        window.location.href = "<?php echo site_url('dashboard/remove_prof_pic'); ?>";
    }
    // If the user clicks "Cancel," do nothing
}
</script>