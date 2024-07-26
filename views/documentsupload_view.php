
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   

    <title><?php echo $title; ?></title>

    <link href="<?php echo base_url('');?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"><!--For icons-->
   <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
   
   <style type="text/css">
      .error{
      color: red;
      }
   </style>
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('');?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<?php
           
                $udata=$this->session->userdata('UserLoginSession');
                $user_name=$udata['name'];

                $user_type=$udata['role'];
                // echo "<pre>";
                // print_r($user_type);exit;
                $files[]=$roleuser->filesdoc;
                $filename_string = implode(', ', $files);

                $stringfiles=explode(',', $filename_string);
                $counts=count($stringfiles);
                
               //  echo "<pre>";
               //  print_r($counts);exit;
           
        ?>
   <input type="hidden" id="id_data" value="<?php echo $user_type;?>" />


<div class="container">
      <table class="table table-bordered table-striped" id="product_list">
         <thead>
            <tr>
               <!-- <th>ID</th> -->
               <th>Hi <?php echo $user_name;?> Your Documents Are:</th> 
            </tr>
         </thead>
         <tbody>
         <tr>       
                
         <td>
            <?php 
            $stringfiles=explode(',', $filename_string);

            $i=0;
            for($i=0; $i<$counts; $i++){
            ?>
            <iframe type="application/pdf" src='<?php echo base_url('uploads/'.trim($stringfiles[$i]));?>'>
            
            </iframe>
            <br/><?php echo $stringfiles[$i]; ?><br/>

            <?php } 
            ?>
         </td>
         </tr>
         </tbody>
      </table>
     
      
   </div>

      
  <!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('');?>assets/vendor/jquery/jquery.min.js"></script>
    <!-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

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