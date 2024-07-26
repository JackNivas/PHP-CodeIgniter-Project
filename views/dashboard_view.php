
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

      .dt-buttons{
         width: 100%;
      }
   </style>
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('');?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<div class="container-fluid">
   <div class="row justify-content-center">
      <div class="col-md-12">
                <?php if (isset($success_message)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success_message; ?>
                </div>
                <?php endif; ?>

                <?php if($this->session->flashdata('error')){ ?>
                <p class="text-danger text-center"> <?=$this->session->flashdata('error') ?></p>
                <?php }?>
<!-- display duplicate emails as error -->
<?php if (isset($duplicates_list) && !empty($duplicates_list)): ?>
    <div class="alert alert-danger">
        <strong>Duplicate Emails:</strong>
        <ul>
            <?php foreach ($duplicates_list as $duplicate): ?>
                <li>Row <?= $duplicate['row'] ?> - Name: <?= $duplicate['name'] ?>, Email: <?= $duplicate['email'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

                <?php
           
                     $udata=$this->session->userdata('UserLoginSession');
                     $user_type=$udata['role'];
                     // echo "<pre>";
                     // print_r($user_type);exit;     
                ?>
                  <input type="hidden" id="id_data" value="<?php echo $user_type;?>" />
                  <div class="card shadow">
                    <div class="card-header">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                    <?php 
                    foreach ($settings_data as $column):
                     $id=$column['dic_id']; ?>
              
                                <?php if ($id==8): ?>
                     <?php
                           foreach ($logo_data as $column1):
                     ?>
                     <h4 class="text-right text-<?= $column1['themecolor'] ?>"><?= $column['pagehead'] ?></h4>
                     <?php endforeach; ?>

                        </div>
                        <?php endif; ?>

                        <?php endforeach; ?>
                    
                    </div>
                    <div class="card-body">
                       
                    <div class="row">
        <div class="col-md-12">
      
            <form action="<?php echo base_url('dashboard/createexcel'); ?>" id="frm_filters" method="post" name="frm_filters">
                <div class="form-group">
                    <label for="filter_title"><b>Filter</b></label>
                    
                    <?php if($filrole != NULL)
                    {?>
                        <input type="text" name="filter_title" id="filter_title" value="<?php echo $filrole;?>" class="col-md-8" maxlength="128" minlength="1">
                    <?php } else {?>
                        <input type="text" name="filter_title" id="filter_title" class="col-md-7" maxlength="128" minlength="1">
                     <?php }?>
                     <?php
                    foreach ($logo_data as $column1):
                     ?>
            
                        <?php //change button names 
                        foreach ($settings_data as $column):
                           $id=$column['dic_id'];
                           
                           if ($id==8):         
                           $tab_heads = $column['buttonhead'];
                        
                           $table_head = explode(', ', $tab_heads);
                           ?>

                                 <input type="submit" name="frm-filter-btn" id="frm-filter-btn" class="col-md-2 btn-<?= $column1['themecolor'] ?>" value="<?= $table_head[1] ?>">
                                 <input type="submit"  class="btn btn-<?= $column1['themecolor'] ?> ml-2" id="customExportButton"  value="<?= $table_head[2] ?>">
                                 <a href="javascript:void(0)"  data-id="<?php echo $filrole;?>"  class="btn btn-<?= $column1['themecolor'] ?> ml-2 create-pdf" name="create-pdf" id="create-pdf"><?= $table_head[3] ?></a>
                           <?php endif; ?>
                           <?php endforeach; ?>
               <?php endforeach; ?>


                </div>
            </form>

      <form method="post" action="<?= base_url('dashboard/import') ?>" enctype="multipart/form-data">
      <div class="form-group">
         <input class="col-md-2" type="file" name="userfile" />
         <?php
         foreach ($logo_data as $column1):
         ?>
         <?php //change button names 
         foreach ($settings_data as $column):
            $id=$column['dic_id'];
            
            if ($id==8):         
            $tab_heads = $column['buttonhead'];
         
            $table_head = explode(', ', $tab_heads);
            ?>
         <input class="btn btn-<?= $column1['themecolor'] ?>" type="submit" value="<?= $table_head[4] ?>" />
         <?php endif; ?>
         <?php endforeach; ?>
         <?php endforeach; ?>

      </div>
      </form>

        </div>
    </div>
</div>
<hr>
<div class="container">
      <?php
      foreach ($logo_data as $column1):
      ?>
      <?php //change button names 
      foreach ($settings_data as $column):
         $id=$column['dic_id'];
         
         if ($id==8):         
         $tab_heads = $column['buttonhead'];
      
         $table_head = explode(', ', $tab_heads);
         ?>
      <a href="javascript:void(0)" class="btn btn-<?= $column1['themecolor'] ?> ml-3" id="create-new-product"><?= $table_head[0] ?></a>

      <?php endif; ?>
      <?php endforeach; ?>
      <?php endforeach; ?>

   <br><br>

      

      <table class="table table-bordered table-striped" id="product_list">
         <thead>
            <tr>
               <!-- <th>Name</th>
               <th>Email</th>
               <th>Role</th>
               <th>Status</th>
               <th>Profile Pic</th>
               <th>Register Date</th>
               <th>Actions</th> -->
               
<?php foreach ($settings_data as $column):
       $id=$column['dic_id'];
       
       if ($id==8):         
      $tab_heads = $column['tablehead'];
     
      $table_head = explode(', ', $tab_heads);
      $counts = count($table_head);
      

      for ($i = 0; $i < $counts; $i++) : ?>

      <th><?= $table_head[$i] ?></th>

      <?php endfor; ?>
      <?php endif; ?>
      <?php endforeach; ?>

<?php

               //  if (is_array($employee_page_columns)) {
               //       foreach ($employee_page_columns as $column) {
               //          echo '<th>' . $column . '</th>';
               //       }
               //    } else {
               //       // Handle the case when $table_columns is null or not an array
               //       echo '<th>No columns defined</th>';
               //    }?>
               
            </tr>
         </thead>
         <tbody>
         <?php if($employees): 
            // $count=count($employees);
              
            foreach($employees as $row):
               // $status_name=$row['status'];
               
               
               ?>
            <tr id="product_id_<?php echo $row->id;?>">
               <!-- <td><?php echo $row->id;?></td> -->
               <td><?php echo $row->name;?></td>
               <td><?php echo $row->email;?></td>
               <td><?php echo $row->role;?></td>

               <td><?php echo $row->status;?></td>

               <td style="width: 20%;">
               
                  <img class="img-profile rounded-circle" style="width:20%; height:20%;" src="<?php echo base_url('uploads/'.$row->profpic); ?>"/>
               </td>
               
               <?php 
               $date= new DateTime($row->datecreateon);
               $date1= new DateTime($row->dateupdatedon);
               $date1->format("j-M-Y h:i:s a");
               ?>
               <td><?php echo $date->format("j-M-Y h:i:s a");?></td>
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
               
               
               
               <td>
               <?php  foreach ($logo_data as $column1): ?>
                  <a  href="javascript:void(0)" data-id="<?php echo $row->id;?>" class="btn btn-<?= $column1['themecolor'] ?> show-user mb-2">
                  <i class="bi bi-binoculars"></i></a>
                  <?php            
               // $url=base_url('dashboard/accessperuser');
                     //  echo "<pre>";
                     //  print_r($url);exit;
               if ($accessarray[1] == 'Edit'):       ?>
                  <a id="user-hide" href="javascript:void(0)"  data-id="<?php echo $row->id;?>" class="btn btn-<?= $column1['themecolor'] ?> edit-product">
                  <i class="bi bi-pencil-square"></i></a>
                  
                  <?php endif; ?>
                  <?php endforeach; ?>

                  <?php            
               // $url=base_url('dashboard/accessperuser');
                     //  echo "<pre>";
                     //  print_r($url);exit;
               if ($accessarray[2] == 'Delete'):       ?>
               <a id="user-hide" href="javascript:void(0)" data-id="<?php echo $row->id;?>" class="btn btn-danger delete-product">
               <i class="bi bi-trash3"></i></a>
                  <?php endif; ?>
               </td>
            </tr>
            <?php endforeach;?>
            <?php endif; ?>
         </tbody>
      </table>
   </div>
 
   <!-- Model for add edit product -->

   <div class="modal fade" id="ajax-product-modal" aria-hidden="true">

      <div class="modal-dialog">
         <div class="modal-content">

            <div class="modal-header d-flex justify-content-center align-items-center mb-3">
               <h4 class="modal-title" id="productCrudModal"></h4>
            </div>

            <div class="modal-body">
               <form id="productForm" name="productForm" class="form-horizontal">
                  
               <input type="hidden" name="product_id" id="product_id">
                  
                  <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Name</label>
                     <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Tilte"
                         value="" maxlength="50" required="">
                     </div>
                  </div>

                 

                  <div class="form-group">
                  <?php if (isset($errors)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $errors; ?>
                </div>
                <?php endif; ?>
                     <label class="col-sm-2 control-label">Email</label>
                     <div class="col-sm-12">
                        <input type="text" class="form-control" id="email" name="email"
                         placeholder="Enter Description" value="" required="">
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Role</label>
                     <div class="col-sm-12">
                        <!-- <input type="text" class="form-control" id="role" name="role"
                         placeholder="Enter Description" value="" required=""> -->
                         <select class="form-control" id="role" name="role" required="">
                        <!-- Options will be dynamically added here through AJAX -->
                        </select>
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Status</label>
                     <div class="col-sm-12">
                        <input type="text" class="form-control" id="status" name="status"
                         placeholder="Enter Description" value="" required="">
                     </div>
                  </div>

                  <div class="col-sm-offset-2 col-sm-10">
                  <?php
                    foreach ($logo_data as $column):
                                    // echo "<pre>";print_r($column);exit;
            ?>
                     <button type="submit" class="btn btn-<?= $column1['themecolor'] ?>" id="btn-save" value="create">Save changes</button>
                     <?php endforeach; ?>

                  </div>

               </form>
            </div>
            <div class="modal-footer">
            </div>
         </div>

      </div>
   </div>

<!-- Form to show ID wise data -->
<div class="modal fade  md-12" id="ajax-user-modal" aria-hidden="true">

      <div class="modal-dialog">
         <div class="modal-content">

            <div class="modal-header d-flex justify-content-center align-items-center mb-3">
               <h4 class="modal-title" id="userCrudModal"></h4>
            </div>

            <div class="modal-body">
               <form id="productForm" name="productForm" class="form-horizontal">
                  
               <div class="form-group">               
               <div class="col-md-12"><span class="text-black-50" id="profpic"> </span></div>
               </div>
               <div class="form-group">               
               <div class="col-md-12 mb-2"><label class="labels" style="color: purple;">Name: </label> <span class="text-black-50" id="username"> </span></div> 
               </div>
               <div class="form-group">               
               <div class="col-md-12  mb-2"><label class="labels" style="color: purple;">Role:</label> <span class="text-black-50" id="Role"> </span></div>
               </div>

               

               <div class="form-group">               
               <div class="col-md-12  mb-2"><label class="labels" style="color: purple;">Contact: </label> <span class="text-black-50" id="contact"> </span></div>
               </div>

               <div class="form-group"> 
               <div class="col-md-12  mb-2"><label class="labels" style="color: purple;">Address: </label> <span class="text-black-50" id="address"> </span></div>
               </div>

               <div class="form-group"> 
               <div class="col-md-12  mb-2"><label class="labels" style="color: purple;">Email:</label> <span class="text-black-50" id="Email"> </span></div>
               </div>

               <div class="form-group"> 
               <div class="col-md-12  mb-2"><label class="labels" style="color: purple;">Qualification:</label> <span class="text-black-50" id="qualification"> </span></div>
               </div>

               <div class="form-group"> 
               <div class="col-md-12  mb-2"><label class="labels" style="color: purple;">Documents Submitted:</label>
               <span class="text-black-50" id="documents"> </span></div>
               </div>

               <div class="form-group"> 
               <div class="col-md-12  mb-2"><label class="labels" style="color: purple;">Date of Join:</label> <?php echo $date->format('j-M-Y h:i:s a');?></div>
               </div>

               <div class="form-group">               
               <div class="col-md-12  mb-2"><label class="labels" style="color: purple;">Date of Last Update:</label> <?php echo $date1->format('j-M-Y h:i:s a');?></div>
               </div>
               <div class="form-group"> 
               <div class="col-md-12  mb-2"><label class="labels" style="color: purple;">Status:</label> <span class="text-black-50" id="Status"> </span></div>
               </div>

               </div>


                 

         </form>
         </div>

      </div>
                    
                    
                    </div>

                </div>
        
            </div>
        
        </div>        
    </div>
   </div>



   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- Include SheetJS (js-xlsx) -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

   </body> 
</html>
<script>
   var SITEURL = '<?php echo base_url(); ?>'; 
         
   
          
   $(document).ready(function() {


   var searchInput = document.getElementById("filter_title");

   var searchInput =$('#filter_title').val();
   console.log(searchInput);
   
   // searchInput.onload = function(){
   $(window).on("load", function() {

   event.preventDefault();

   var table = $('#product_list');

   $.ajax({
    url: "<?= base_url('dashboard/get_by_filters') ?>",
    dataType: 'JSON',
    method: 'POST',
    data: {
        'filter_news_title': $('#filter_title').val()
    },
    success: function(data_return) {
        console.log(data_return);

        // destroy the DataTable
        table.dataTable().fnDestroy();
        // clear the table body
        table.find('tbody').empty();
        // reinitiate
        table.DataTable({
            // # data source as object (JSON object array)
            // You must use the exactly format as shown on the link below
            // https://datatables.net/manual/data/#Objects
            data: data_return,
            columns: [
               {
                    "data": "name"
                },
                {
                    "data": "email"
                },
                {
                    "data": "role"
                },
                {
                    "data": "status"
                },
                {
                    "data": "profpic"
                },
               //  {
               //      "data": "filesdoc"
               //  },
                {
                    "data": "datecreateon"
                },
                {
                    "data": null
                },
            ],
            columnDefs: [{
                    // # hide the first column
                    // https://datatables.net/examples/advanced_init/column_render.html                    
                    "targets": [0],
                    // "visible": false
                },
                {
                    // # hide the first column
                    // https://datatables.net/examples/advanced_init/column_render.html                    
                    "targets": [1],
                                "width": 70
                    // "visible": false
                },
                {
                    // # disable search for column number 2
                    // https://datatables.net/reference/option/columns.searchable                    
                    "targets": [3],
                    
                    "searchable": true,
                    // # disable orderable column
                    // https://datatables.net/reference/option/columns.orderable
                    "orderable": false
                },
                {
                              "targets": [4],
                              "render": function(data, type, row, meta) {
                                 $controlls = '<img class="img-profile rounded-circle" style="width:50%; height:40%;" src="http://localhost/codeigniter/dashboard/uploads/'+row.profpic+'"/>';
                                 return $controlls;
                              },
                                "width": 100
               },
               {
                              "targets": [5],
                              "render": function(data, type, row, meta) {
                                 $controlls = '<?php echo $date->format("j-M-Y h:i:s a");?>';
                                 return $controlls;
                              },
                                "width": 100
               },
                {
                    // # action controller (edit,delete)
                    "targets": [6],
                    // # column rendering
                    // https://datatables.net/reference/option/columns.render
                    "render": function(data, type, row, meta) {
                        // $controlls = '<a  href="<?php echo base_url('dashboard/get_user_by_id/'.' + row.id + ');?>" class="btn btn-success show-user mb-2"><i class="bi bi-binoculars"></i>Doc View</a>';
                        $controlls = '<?php foreach ($logo_data as $column1): ?><a  href="javascript:void(0)" data-id="' + row.id + '" class="btn btn-<?= $column1['themecolor'] ?> show-user mb-1"><i class="bi bi-binoculars"></i></a><br><a id="user-hide" href="javascript:void(0)"  data-id="' + row.id + '" class="btn btn-<?= $column1['themecolor'] ?> edit-product mb-1"><i class="bi bi-pencil-square"></i></a><br><?php endforeach; ?><a id="user-hide" href="javascript:void(0)" data-id="' + row.id + '" class="btn btn-danger delete-product"><i class="bi bi-trash3"></i></a>';
                        // $controlls+= '<a id="user-hide" href="javascript:void(0)"  data-id="' + row.id + '" class="btn btn-primary edit-product"><i class="bi bi-pencil-square"></i></a>';
                        // $controlls+='<a id="user-hide" href="javascript:void(0)" data-id="' + row.id + '" class="btn btn-danger delete-product"><i class="bi bi-trash3"></i></a>';
                        return $controlls;
                    },
                    "width": 100
                }
            ],
            // #set order descending and ascending
            // https: //datatables.net/reference/option/order
            "order": [
                [1, 'desc'],
                [2, 'asc']
            ]
        });
      }
   });
   }); 

   $('#frm-filter-btn').on("click", function() {
      event.preventDefault();

      var table = $('#product_list');

      $.ajax({
            url: "<?= base_url('dashboard/get_by_filters') ?>",
            dataType: 'JSON',
            method: 'POST',
            data: {
               'filter_news_title': $('#filter_title').val()
            },
            success: function(data_return) {
               console.log(data_return);

               // destroy the DataTable
               table.dataTable().fnDestroy();
               // clear the table body
               table.find('tbody').empty();
               // reinitiate
               table.DataTable({
                  // # data source as object (JSON object array)
                  // You must use the exactly format as shown on the link below
                  // https://datatables.net/manual/data/#Objects
                  data: data_return,
                  columns: [
                     {
                           "data": "name"
                        },
                        {
                           "data": "email"
                        },
                        {
                           "data": "role"
                        },
                        {
                           "data": "status"
                        },
                        {
                           "data": "profpic"
                        },
                     //  {
                     //      "data": "filesdoc"
                     //  },
                        {
                           "data": "datecreateon"
                        },
                        {
                           "data": null
                        },
                  ],
                  columnDefs: [{
                           // # hide the first column
                           // https://datatables.net/examples/advanced_init/column_render.html                    
                           "targets": [0],
                           // "visible": false
                        },
                     {
                        // # hide the first column
                        // https://datatables.net/examples/advanced_init/column_render.html                    
                        "targets": [1],
                                    "width": 70
                        // "visible": false
                     },
                        {
                           // # disable search for column number 2
                           // https://datatables.net/reference/option/columns.searchable                    
                           "targets": [3],
                           
                           "searchable": true,
                           // # disable orderable column
                           // https://datatables.net/reference/option/columns.orderable
                           "orderable": false
                        },
                        {
                        "targets": [4],
                        "render": function(data, type, row, meta) {
                           $controlls = '<img class="img-profile rounded-circle" style="width:50%; height:40%;" src="http://localhost/codeigniter/dashboard/uploads/'+row.profpic+'"/>';
                           return $controlls;

                        },
                           "width": 100
                        },
                        {
                        "targets": [5],
                        "render": function(data, type, row, meta) {
                           $controlls = '<?php echo $date->format("j-M-Y h:i:s a");?>';
                           return $controlls;
                        },
                           "width": 100
                        },
                        {
                           // # action controller (edit,delete)
                           "targets": [6],
                           // # column rendering
                           // https://datatables.net/reference/option/columns.render
                           "render": function(data, type, row, meta) {
                              $controlls = '<?php foreach ($logo_data as $column1): ?><a  href="javascript:void(0)" data-id="' + row.id + '" class="btn btn-<?= $column1['themecolor'] ?> show-user mb-1"><i class="bi bi-binoculars"></i></a><br><a id="user-hide" href="javascript:void(0)"  data-id="' + row.id + '" class="btn btn-<?= $column1['themecolor'] ?> edit-product mb-1"><i class="bi bi-pencil-square"></i></a><br><?php endforeach; ?><a id="user-hide" href="javascript:void(0)" data-id="' + row.id + '" class="btn btn-danger delete-product"><i class="bi bi-trash3"></i></a>';
                              // $controlls+= '<a id="user-hide" href="javascript:void(0)"  data-id="' + row.id + '" class="btn btn-primary edit-product"><i class="bi bi-pencil-square"></i></a>';
                              // $controlls+='<a id="user-hide" href="javascript:void(0)" data-id="' + row.id + '" class="btn btn-danger delete-product"><i class="bi bi-trash3"></i></a>';
                              return $controlls;
                           },
                           "width": 100
                        }
                  ],
                  // #set order descending and ascending
                  // https: //datatables.net/reference/option/order
                  "order": [
                        [1, 'desc'],
                        [2, 'asc']
                  ]
               });
            }
      });

   });

       
}); // document ready ends


//Datatable to store data
   $(document).ready(function () {
 
      $("#product_list").DataTable();                      //loads product_list datatable

      /*  When click Add New button with id=create-new-product*/
 
      $('#create-new-product').click(function () {
            $('#btn-save').val("create-new-product");        //id btn-save selector with value create-new-product
            $('#product_id').val('');                        //set the input product_id field to empty if have any data
            $('#productForm').trigger("reset");              //reset the form fields
            $('#productCrudModal').html("Add New Employee");  //set H4 heading to "Add New Product" of the Modal while pop up
            $('#ajax-product-modal').modal('show');          //Show the modal from with id=#ajax-product-modal

      });
 
     
      if ($("#productForm").length > 0)                     //checks form is greater than 0
      {
         
         $("#productForm").validate({

         submitHandler: function (form)
         {
            var actionType = $('#btn-save').val();          //method returns or sets the value attribute of the selected elements
            $('#btn-save').html('Sending..');               //set the button value to Sending..

            $.ajax({
               data: $('#productForm').serialize(),         //serialize() method creates a URL encoded text string by serializing form values
               url: SITEURL + "dashboard/store",              //set the site URL, here call to 'product' controller and then 'store' method 
               type: "POST",                                //form method type POST
               dataType: 'json',                            //transfer URL encoded text json type of data 
               success: function (res)
               {
                                                            //create the append child table row of data with the res

   		      var product = '<tr id="product_id_' + res.data.id + '"><td>'
               + res.data.name + '</td><td>' + res.data.email + '</td><td>' + res.data.role + '</td><td>'
                + res.data.status + '</td><td style="width:20%;"><img class="img-profile rounded-circle" style="width:30%; height:30%;" src="<?php echo base_url('uploads/'); ?>"/>' + res.data.profpic + '</td><td>' + res.data.datecreateon + '</td>';
 
               product += '<td><?php foreach ($logo_data as $column1): ?><a href="javascript:void(0)" id="" data-id="' + res.data.id + '" class="btn btn-<?= $column1['themecolor'] ?> edit-product"><i class="bi bi-pencil-square"></i></a><?php endforeach; ?><a href="javascript:void(0)" id="" data-id="' + 				res.data.id + '" class="btn btn-danger delete-product"><i class="bi bi-trash3"></i></a></td></tr>';
               
               //User Add Actionlogs
               logUserAction('Add Record with ID: ' + res.data.id, 'Employee Menu', 'Details of the Added record: ' + res.data.name + ', ' + res.data.email + ', ' + res.data.role + ', ' + res.data.status);

               
                 if (actionType == "create-new-product") {
                   
                     $('#product_list').append(product);      //append data as the last child of the table
                     alert("Successfully Data Added!");


                  } else {                                     // replace selected row with the updated data that stored in variable product
                     $("#product_id_" + res.data.id).replaceWith(product);
                     alert("Successfully Data Updated!");


                 }
 
                  $('#productForm').trigger("reset");             //reset form fields
                  $('#ajax-product-modal').modal('hide');         //hide the modal pop up window
                  $('#btn-save').html('Save Changes');            //change the button value

               },
               error: function (data) {
                  console.log('Error:', data);
                  alert('Error:', data);

                  $('#btn-save').html('Save Changes');
               }
            });
         }
      })
   }

/* When click show icon button with class="show-user" */
 
$('body').on('click', '.show-user', function () {
 
 var product_id = $(this).data("id");      //selected id value saved in variable product_id

 console.log(product_id);                  //consoles the product id

 $.ajax({
    type: "Post",
    url: SITEURL + "dashboard/get_product_by_id",           
    data:
    {
       id: product_id
    },

    dataType: "json",
    success: function (res)
    {
       if (res.success == true) {

          $('#ajax-user-modal').modal('show');
          $('#userCrudModal').html("View Employee Details");//heading changed to Edit Product of the Modal
          $('#profpic').html('<img class="img-profile rounded-circle" style="width:30%; height:30%;" src="http://localhost/codeigniter/dashboard/uploads/'+res.data.profpic+'"/>');
          $('#Role').html(res.data.role);
          $('#user_id').val(res.data.id);
          $('#username').html( res.data.name);
          $('#contact').html(res.data.mobile);
          $('#address').html(res.data.address);
          $('#Email').html(res.data.email);
          $('#qualification').html(res.data.education);
          $('#datecreated').html(res.data.datecreateon);
          $('#dateupdated').html(res.data.dateupdatedon);
          $('#Status').html(res.data.status);

          

       }
    },

    error: function (data)
    {
       console.log('Error:', data);
    }
 });
});


 /* When click edit button with class="edit-product" */
 
      $('body').on('click', '.edit-product', function () {
 
         var product_id = $(this).data("id");      //selected id value saved in variable product_id

         console.log(product_id);                  //consoles the product id

         $.ajax({
            type: "Post",
            url: SITEURL + "dashboard/get_product_by_id",           
            data:
            {
               id: product_id
            },

            dataType: "json",
            success: function (arr)
            {

               if (arr.success == true) {

                  $('#productCrudModal').html("Edit Employee Details");//heading changed to Edit user of the Modal
                  $('#btn-save').val("edit-product");
                  $('#ajax-product-modal').modal('show');
                  $('#product_id').val(arr.data.id);
                  $('#name').val(arr.data.name);
                  $('#email').val(arr.data.email);
                  // $('#role').val(res.data.role);
                  $('#status').val(arr.data.status);
                  $('#profpic').val(arr.data.profpic);
                  
                  //call to loguserAction function for edit button
                  logUserAction('Edited the Record ID: ' + arr.data.id, 'Employee Menu', 'Details of the edited record: ' + arr.data.name);

                  // Populate the "Role" dropdown
                  var roleSelect = $('#role');
                  roleSelect.empty(); // Clear existing options

                  $.each(arr.roles, function (index, item) {
                     roleSelect.append($('<option>', {
                        value: item.roletype,
                        text: item.roletype
                     }));
                  });

               var roleValue = arr.data.role;

               var selectedOption = $('#role').find('option[value="' + roleValue + '"]');
               console.log('selectedOption:', selectedOption);

               if (selectedOption && selectedOption.length > 0) {
                  $('#role').val(roleValue);
               } else {
                  // Provide a fallback option or handle the case where the value is not found
                  console.error('Option with value ' + roleValue + ' not found in the select box.');
               }


               }
            },

            error: function (data)
            {
               console.log('Error:', data);
            }
         });
      });

      
      /* When click delete button*/

      $('body').on('click', '.delete-product', function ()
      {
         var product_id = $(this).data("id");

         if (confirm("Are you sure want to delete ID:" +product_id))
         {
            $.ajax({
               type: "Post",
               url: SITEURL + "dashboard/delete",
               data:
               {
                  product_id: product_id
               },
               dataType: "json",
               success: function (data) {
                  $("#product_id_" + product_id).remove();
                  alert("User Record: " + product_id + " has been deleted successfully !");
                  
                  //call to loguserAction function for edit button
                  logUserAction('Deleted the Record ID: ' + product_id, 'Employee Menu', 'Details of the deleted record: ' + product_id);

               },
               error: function (data) {
                  console.log('Error:', data);
               }
            });
         }
      });

   $('body').on('click', '#create-pdf', function ()
   {

         var filterkey = $('#filter_title').val();

         console.log(filterkey);
      $.ajax({
               url: "<?= base_url('dashboard/createpdfusers') ?>",
                dataType: 'JSON',
                method: 'POST',
                data: {
                  'filter_news_title': $('#filter_title').val()
                },
        success: function(response) {

         var fileName = response.fileName;

            // Check if the response indicates success
            if (response.success) {
                // If successful, create a download link
                var downloadLink = document.createElement('a');
                downloadLink.href = response.file_url; // Assuming the controller returns the file URL
                downloadLink.download = fileName;
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            } else {
                // Handle errors if needed
                console.error('Error generating PDF');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle AJAX errors if needed
            console.error("AJAX Error:", textStatus, errorThrown);
                        
            // Log the response text for further investigation
            console.log(jqXHR.responseText); // Log the response for further inspection

        }
                
      });
   });


   
   })   

   $(document).ready(function () {
        // Replace this URL with your actual endpoint to fetch dynamic data

        // AJAX request to fetch dynamic data
        $.ajax({
            type: 'GET',
            url: '<?= base_url('dashboard/getroletypes') ?>',
            dataType: 'JSON',
            success: function (data) {
               console.log(data);
                // Assuming data is an array of objects with 'id' and 'name' properties
                var selectBox = $('#role');
                console.log(selectBox.length);

                // Clear existing options
                selectBox.empty();

                // Add default option
                selectBox.append($('<option>', {
                    value: '',
                    text: 'Select Role'
                }));

                // Populate select box with dynamic data
                $.each(data, function (index, item) {
                  if (item !== null && item !== undefined) {

                    selectBox.append($('<option>', {
                        value: item.roletype,
                        text: item.roletype
                    }));
                  }
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
               console.error("AJAX Error:", textStatus, errorThrown);
            }
        });
    });

   
// Function to log user action
function logUserAction(action, menu_item, additional_info) {
    console.log(action);

    $.ajax({
        url: '<?php echo base_url('dashboard/log_action'); ?>',
        type: 'POST',
        data: {
            action: action,
            menu_item: menu_item,
            additional_info: additional_info
        },
        success: function(response) {
            console.log('Success:', response);
            // Handle success response
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
            // Handle error response
        }
    });
}

</script>