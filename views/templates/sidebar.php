<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <style>
        
        
    .nav-item .active{
        background-color:#1B3E70;
        color:white;

    }
    #container-change{
        padding-left: 0rem;
        padding-right: 0rem;
        margin-left:1px;
        margin-right:1px;
    }
    .sidebar-brand-icon {
    /* Add any styling you want for the container div */
        }

        .img-profile {
            width: 50px; /* Adjust the width as per your preference */
            height: 50px; /* Adjust the height as per your preference */
            object-fit: cover; /* This property controls how the image is resized within its container */
            /* Add any additional styling for the image */
        }

        .rounded-circle {
            border-radius: 50%; /* This creates a circular shape for the image */
        }
/* loader styles*/        
        body {
            margin: 0;
            overflow: hidden; /* Prevent scrolling while loader is visible */
            transition: opacity 0.5s ease-in-out; /* Add a smooth transition effect for opacity changes */

        }

        .loader {
            display: none; /* Initially hide the loader */
            border: 10px solid #f3f3f3; /* Light grey */
            border-top: 10px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 80px;
            height: 80px;
            position: fixed;
            top: 50%;
            left: 50%;
            margin-top: -60px; /* Half of the height */
            margin-left: -60px; /* Half of the width */
            animation: spin 1s linear infinite, fadeIn 0.5s ease-in-out forwards;
            z-index: 999; /* Ensure it appears on top of other elements */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
        <script>
        window.addEventListener('load', function () {
            // Show the loader when the page starts loading
            document.body.style.opacity = '0'; // Start with opacity set to 0
            document.querySelector('.loader').style.display = 'block';

            // Hide the loader and restore opacity when the page has finished loading
            setTimeout(function () {
                document.querySelector('.loader').style.display = 'none';
                document.body.style.opacity = '1'; // Restore opacity
                document.body.style.overflow = 'auto'; /* Restore scrolling */
            }, 500); // Adjust the time as needed
        });
    </script>

    <title>SN Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('');?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('');?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    

</head>

<body id="page-top">
<div class="loader"></div>

        <?php
           
                $udata=$this->session->userdata('UserLoginSession');
                $user_type=$udata['role'];
                $accesstype=$udata['accesstypes'];
                $uid=$udata['id'];
                $accessarray=explode(', ',$accesstype);
        ?>
   
<!-- Page Wrapper -->
<div id="wrapper">

        <!-- Sidebar -->
        <?php
            foreach ($logo_data as $column):
            // echo "<pre>";print_r($column);exit;
        ?>
        <ul class="navbar-nav bg-gradient-<?= $column['themecolor'] ?> sidebar sidebar-dark">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center" href="#">
            
                <div class="sidebar-brand-icon">
                    <img class="img-profile rounded-circle" src="<?php echo base_url('uploads/'.$column['logoImage']); ?>" alt="logo">
                </div>
                <div class="sidebar-brand-text mx-3"><?= $column['logoName'] ?></div>
                <?php endforeach; ?>

            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('GeneralDash'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li id="hideaccess" class="nav-item">
                <?php foreach ($settings_data as $column): 
                $allowedMenuItems = $accessarray;
                $hasAccess = in_array(trim($column['sideheadid']), $accessarray, true);
                // Check if the user has access to the current menu item
                if ($hasAccess): ?>

                <a class="nav-link" href="<?php echo base_url('dashboard/'.$column['sideurl']); ?>">
                    <i class='bi bi-<?php echo $column['sideicon']; ?>'></i>
                    <?php
                    // Display different menu item text based on user type
                    echo ($user_type == 'Admin') ? $column['sidehead'] : $column['sideheaduser'];
                    ?>
                </a>

                <?php endif; 
                      endforeach; ?>
            </li>
            
            
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
        </ul>
        <!-- Begin Page Content -->
         <div class="container-fluid m-0" id="container-change">



        <!-- End of Sidebar -->
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('');?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('');?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('');?>assets/js/sb-admin-2.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    
