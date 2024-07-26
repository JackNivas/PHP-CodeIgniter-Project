
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
<?php if($this->session->flashdata('success')){ ?>
        <p class="text-success text-center"> <?=$this->session->flashdata('success') ?></p>
    <?php }?>

    <?php if($this->session->flashdata('error')){ ?>
        <p class="text-danger text-center"> <?=$this->session->flashdata('error') ?></p>
    <?php }?>

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
                        
                    <?php foreach ($logo_data as $column): ?>
                    <h4 class="text-right text-<?= $column['themecolor'] ?>">Edit Access</h4>
                    <?php endforeach; ?>
                    </div>
                    </div>
                    <div class="card-body">
                       
                    <?php echo form_open_multipart('dashboard/accessupdate'); ?>

                        <div class="row mt-3">

                        <div class="col-md-12 mb-3">
                        <?php echo form_error('name'); ?>
                        <div class="row mt-3">

                            <div class="col-md-12 mb-3">
                            <?php echo form_error('name'); ?>

                            <label class="labels">Name:</label>
                            <select name="name" id="name" class="form-control">
                            <option name="accessuser" value="<?php echo $accesseditpage->accessid;?>">
                            <?php echo $accesseditpage->username;?>
                            </option>                
                            </select>

                            </div>
                    
                                <input type="hidden" name="accessuser" value="<?php echo $accesseditpage->accesstypes; ?>">
                                <input type="hidden" name="accessuser" value="<?php echo $accesseditpage->accessbutton; ?>">

                                <?php 
                                $access=$accesseditpage->accesstypes;
                                $straccess=explode(', ', $access);
                                $accessbuttons=$accesseditpage->accessbutton;
                                $straccessbuttons=explode(', ', $accessbuttons);


                                ?>
                        <div class="col-md-12 mb-2 border border-3">
                        <label class="labels">Menu Access:</label>

                        <div class="col-md-12 mb-2">
                        <input type="checkbox" name="accessMenu" value="Access" <?php if($straccess[0]=='Access'){ echo 'checked';} ?>>
                        <label for="accessMenu"> Access</label>

                        </div>

                        <div class="col-md-12 mb-2">   
                        <input type="checkbox" name="hrMenu" value="HR" <?php if($straccess[1]=='HR'){ echo 'checked';} ?>>
                        <label for="hrMenu"> HR</label>

                        </div>

                        <div class="col-md-12 mb-2">
                        <input type="checkbox" name="managerMenu" value="Manager" <?php if($straccess[2]=='Manager'){ echo 'checked';} ?>>
                        <label for="managerMenu"> Manager</label>

                        </div>
                        <div class="col-md-12 mb-2">
                        <input type="checkbox" name="documentsMenu" value="Documents" <?php if($straccess[3]=='Documents'){ echo 'checked';} ?>>
                        <label for="documentsMenu"> Documents</label>

                        </div>
                        <div class="col-md-12 mb-2">
                        <input type="checkbox" name="detailsMenu" value="Details" <?php if($straccess[4]=='Details'){ echo 'checked';} ?>>
                        <label for="detailsMenu"> All Details</label>

                        </div>
                        <div class="col-md-12 mb-2">
                        <input type="checkbox" name="Role" value="Role" <?php if($straccess[5]=='Role'){ echo 'checked';} ?>>
                        <label for="Role"> Role</label>

                        </div>
                        <div class="col-md-12 mb-2">
                        <input type="checkbox" name="Dictionary" value="Dictionary" <?php if($straccess[6]=='Dictionary'){ echo 'checked';} ?>>
                        <label for="Dictionary"> Dictionary</label>

                        </div>
                        <div class="col-md-12 mb-2">
                        <input type="checkbox" name="directoryLogs" value="Directory Logs" <?php if($straccess[7]=='Directory Logs'){ echo 'checked';} ?>>
                        <label for="directoryLogs">Directory Logs</label>

                        </div>
                        <div class="col-md-12 mb-2">
                        <input type="checkbox" name="settings" value="Settings" <?php if($straccess[8]=='Settings'){ echo 'checked';} ?>>
                        <label for="settings">Settings</label>

                        </div>
                        <div class="col-md-12 mb-2">
                        <input type="checkbox" name="employee" value="Employee" <?php if($straccess[9]=='Employee'){ echo 'checked';} ?>>
                        <label for="employee">Employee</label>

                        </div>
                </div>
                <div class="col-md-12 mb-2 border border-3">
                        <label class="labels">Button Access:</label>
                    <div class="col-md-12 mb-2">

                        <input type="checkbox" name="add" value="Add" <?php if($straccessbuttons[0]=='Add'){ echo 'checked';} ?>>
                        <label for="accessMenu"> Add Button</label>

                        </div>

                        <div class="col-md-12 mb-2">   
                        <input type="checkbox" name="edit" value="Edit" <?php if($straccessbuttons[1]=='Edit'){ echo 'checked';} ?>>
                        <label for="hrMenu"> Edit Button</label>

                        </div>

                        <div class="col-md-12 mb-2">
                        <input type="checkbox" name="delete" value="Delete" <?php if($straccessbuttons[2]=='Delete'){ echo 'checked';} ?>>
                        <label for="managerMenu"> Delete Button</label>

                        </div>
                </div>
                        
                        <div class="mt-5 text-center">
                        <?php
                                foreach ($logo_data as $column):
                                                // echo "<pre>";print_r($column);exit;
                        ?>
                        <a href="<?php echo base_url('dashboard/accessDashboard');?>" name="editsubmit"  class="btn btn-<?= $column['themecolor'] ?> profile-button">Back</a>    

                            <input type="submit"  class="btn btn-<?= $column['themecolor'] ?> profile-button" name="submit" value="Update Access">
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
