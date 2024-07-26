
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SN Admin 2 - Dashboard</title>

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

<body>
    <!-- <div>
    <div id="loader-overlay">
    <div class="loader"></div>
</div></div> -->
  
<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <?php

                //     echo"<pre>";
                //    print_r($profiles);exit;   
            if($this->session->userdata('UserLoginSession'))
            {
                $udata=$this->session->userdata('UserLoginSession');
                
            }
            else{
                redirect(base_url('dashboard/login'));
                }

                // $new_profile_picture_path = 'uploads/' . $profiles->$profpic;
                // $this->session->set_userdata('profile_picture', $new_profile_picture_path);
        ?>
       




        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $udata['name']; ?></span>  
                    <?php             
                        $udata = $this->session->userdata('UserLoginSession');
                        $profpic = $this->session->userdata('profile_picture');
                     if (!$profpic == "") { ?>
                      <img class="img-profile rounded-circle" style="border: gray 2px solid;" src="<?php 
                            $udata = $this->session->userdata('UserLoginSession');
                            $profpic = $this->session->userdata('profile_picture');
                            $imagePath = base_url('uploads/' . $profpic);

                            if ($profpic == "" || !file_exists('uploads/' . $profpic)) {
                                // Use the default image if the user does not have a profile picture or if the file doesn't exist
                                $imagePath = base_url('uploads/default.jpg');
                            }
                            

                            echo $imagePath;
                        ?>">
                        
                    <?php } elseif(!$udata == "") { ?>
                        <img class="img-profile rounded-circle" style="border: gray 2px solid;" src="<?php 
                            $udata = $this->session->userdata('UserLoginSession');
                            $profpic = $this->session->userdata('profile_picture');
                            $imagePath = base_url('uploads/' . $udata['profpic']);
                            
                            

                            echo $imagePath;
                        ?>">
                    <?php } else { ?>

                        <img class="img-profile rounded-circle" style="border: gray 2px solid;" src="<?php echo base_url('uploads/default.jpg'); ?>">

                    <?php } ?>


                  

                </a>
                
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo base_url('dashboard/index');?>">
                    <i class="bi bi-person-square"></i>
                        Profile
                    </a>
                    
                    <a class="dropdown-item" href="<?php echo base_url('dashboard/change_password');?>">
                    <i class="bi bi-pencil-square"></i>
                        Change Password
                    </a>
                  
                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?=base_url('dashboard/logout')?>">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                </div>
            </li>

        </ul>

    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 
 
</body>
</html>



