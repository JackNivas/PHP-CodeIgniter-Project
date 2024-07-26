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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"><!--For icons-->
   <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
      
   <div class="container">
   <div class="d-flex justify-content-center align-items-center mb-3">
   <?php foreach ($settings_data as $column):
   $id=$column['dic_id']; ?>
   <?php if ($id==2): ?>
   <?php foreach ($logo_data as $column1): ?>
                     <h4 class="text-right text-<?= $column1['themecolor'] ?>"><?= $column['pagehead'] ?></h4>
   <?php endforeach; ?>

   <?php endif; ?>

   <?php endforeach; ?>
   </div>
    <?php
            
            $udata=$this->session->userdata('UserLoginSession');
            $user_type=$udata['role'];
            $accessbutton=$udata['accessbutton'];
            // $accesstype=$accesssidebar->accesstypes;

            $accessarray=explode(', ',$accessbutton);
            $counts=count($accessarray);
         //  echo "<pre>";
         //  print_r($udata['accessbutton']);exit;
            
            
      ?>
   
    
      <?php            
     
      if ($accessarray[0] == 'Add'):       ?>
      <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-product">Add New</a>
      <?php endif; ?>
      <br><br>
      <table class="table table-bordered table-striped" id="product_list">
         <thead>
            <tr>
               <!-- <th>ID</th> -->
               <th>Pages</th>
               <th>Page Heading</th>
               <th>Table Column Heading</th>
               <th>Actions</th>

            </tr>
         </thead>
         <tbody>
         
            <tr>
               <td>Access</td>
               <td>Access Listing</td>
               <td>Name, Access Menus, Access Buttons</td>

               <td>

      <?php            
      if ($accessarray[1] == 'Edit'):
      ?>
   
      <a  href="javascript:void(0)" data-id="" class="btn btn-info show-user mb-2 edit-product">
      <i class="bi bi-pencil-square"></i></a>
   
      <?php endif; ?>

      <?php            
            //  echo "<pre>";
            //  print_r($url);exit;
      if ($accessarray[2] == 'Delete'):       ?>
      
      <a href="javascript:void(0)" data-id="" class="btn btn-danger mb-2 delete-product">
      <i class="bi bi-trash3"></i></a>
      
      <?php endif; ?>

               </td>
            </tr>
           
         </tbody>
      </table>
   </div>

   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>


   </body> 
</html>