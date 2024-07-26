
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
<!-- Begin Page Content -->
<!-- <div class="container-fluid">    
<div class="container justify-content-center">
<div class="card-header"><h1>Hi <?php echo $udata['name']; ?>! Your Profile</h1></div>
<div class="card border-primary mb-3">
<div class="mb-3">

<div class="container">
      <a href="javascript:void(0)" class="btn btn-info mt-3" id="create-new-product">Add New</a>
      <br><br>
      <table class="table table-bordered table-striped" id="product_list">
         <thead>
            <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Email</th>
               <th>Role</th>
               <th>Status</th>
               <th>Registered Date</th>
               <th>Updated Date</th>
               <th>Actions</th>
            </tr>
         </thead>
         
         

      </table>
   </div>

</div>
</div>
</div>
</div>
</div> -->

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
                <img class="rounded-circle mt-3" id="previewImage" width="150px" src="<?php echo base_url('uploads/'.$profiles->profpic); ?>">
                <?php }?>
                <span class="font-weight-bold"><?php echo $udata['name']; ?></span>
                <span class="text-black-50"><?php echo $udata['email']; ?></span><span> </span>
                <?php 
                $date= new DateTime($udata['datecreateon']);
                
                ?>
                <span class="text-black-50">Date of Join: <?php echo $date->format('j-M-Y'); ?></span>
                <span class="text-black-50">Role: <?php echo $udata['role']; ?></span>

            </div>
        </div>

        <div class="col-md-9">
            <div class="p-3 py-5">
                <?php echo form_open_multipart('dashboard/profileUpdate'); ?>
                
                <div class="row mt-3">
                    <div class="col-md-12 mb-2">
                        <label class="labels">Name</label><input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $profiles->name; ?>">
                    </div>
                    <?php echo form_error('name'); ?>

                    <div class="col-md-12  mb-2">
                        <label class="labels">Mobile Number</label><input type="text" name="mobile" class="form-control" placeholder="Enter phone number" value="<?php echo $profiles->mobile; ?>">
                    </div>
                    <?php echo form_error('mobile'); ?>

                    <div class="col-md-12  mb-2">
                        <label class="labels">Address</label><input type="text" name="address" class="form-control" placeholder="Enter address" value="<?php echo $profiles->address; ?>">
                    </div>
                    <?php echo form_error('address'); ?>
                    <!-- <div class="col-md-12"><label class="labels">City</label><input type="text" class="form-control" placeholder="Enter city" value=""></div>
                    <div class="col-md-12"><label class="labels">State</label><input type="text" class="form-control" placeholder="Enter state" value=""></div>
                    <div class="col-md-12"><label class="labels">Postcode</label><input type="text" class="form-control" placeholder="Enter postal code" value=""></div> -->
                    <div class="col-md-12  mb-2">
                        <label class="labels">Email ID</label><input type="text" name="email" class="form-control" placeholder="enter email id" value="<?php echo $profiles->email; ?>">
                    </div>
                    <?php echo form_error('email'); ?>

                    <div class="col-md-12  mb-2">
                        <label class="labels">Education</label><input type="text" name="education" class="form-control" placeholder="education" value="<?php echo $profiles->education; ?>">
                    </div>
                    <?php echo form_error('eduation'); ?>

                        </div>
                            <?php
                            if($this->session->flashdata('error')){ ?>
                            <p class="text-danger text-center"> <?=$this->session->flashdata('error') ?>
                            </p><?php }?>
                            <div class="col-md-12  mb-2">
                            <label class="labels">Choose Profile Picture: </label>
                            <input type="file"  name="userfiles" onchange="previewImage(this)" size="20" />
                            <!-- <input type="submit"  class="btn btn-primary profile-button" name="fileSubmit" value="Upload"> -->
                            </div>

                            

                        
                        <div class="mt-5 text-center">
                        <?php
                            foreach ($logo_data as $column1):
                            ?>
                            <a class="btn btn-<?= $column1['themecolor'] ?> profile-button" href="<?php echo base_url('dashboard/index');?>">Back</a>

                            <input type="submit"  class="btn btn-<?= $column1['themecolor'] ?> profile-button" name="profilesubmit" value="Update Profile">

                            <?php endforeach; ?>
                        </div>

                        <?php form_close(); ?>
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

    <!-- Page level plugins -->
    <script src="<?php echo base_url('');?>assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url('');?>assets/js/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url('');?>assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>
<script>
        function previewImage(input) {
            var preview = document.getElementById('previewImage');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        } </script>
        