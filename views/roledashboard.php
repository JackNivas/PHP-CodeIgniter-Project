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
   <div class="container-fluid table-container mb-2">
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

                <div class="card shadow">
                    <div class="card-header">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                    <?php   foreach ($settings_data as $column):
                     $id=$column['dic_id'];
                     if ($id==11):  ?>
                    <?php
                    foreach ($logo_data as $column1):
                                    // echo "<pre>";print_r($column);exit;
                     ?>
                    <h4 class="text-right text-<?= $column1['themecolor'] ?>"><?= $column['pagehead'] ?></h4>
                    <?php endforeach; ?>

                     <?php endif; ?>

                     <?php endforeach; ?>
                    
                    </div>
                    </div>

                    <div class="card-body">
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


                  <?php  if ($accessarray[0] == 'Add'):       ?>
                  <?php
                  foreach ($logo_data as $column1):
                                 // echo "<pre>";print_r($column);exit;
                  ?>
                     <?php //change button names 
                      foreach ($settings_data as $column):
                          $id=$column['dic_id'];
                          
                          if ($id==11):         
                          ?>
                           <a href="javascript:void(0)" class="btn btn-<?= $column1['themecolor'] ?> ml-3" id="create-new-product"><?= $column['buttonhead'] ?></a>

                          <?php endif; ?>
                     <?php endforeach; ?>
               <?php endforeach; ?>

               <?php endif; ?>
               <br><br>
               <table class="table table-bordered table-striped" id="product_list">
                  <thead>
                     <tr>
                        <!-- <th>Id</th>
                        <th>Roles</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th> -->
                        <?php foreach ($settings_data as $column):
                        $id=$column['dic_id'];
                        
                        if ($id==11):         
                        $tab_heads = $column['tablehead'];
                        
                        $table_head = explode(', ', $tab_heads);
                        $counts = count($table_head);
                        

                        for ($i = 0; $i < $counts; $i++) : ?>

                        <th><?= $table_head[$i] ?></th>

                        <?php endfor; ?>
                        <?php endif; ?>
                        <?php endforeach; ?>

                     </tr>
                  </thead>
                  <tbody>
                  <?php if($no_docs_persons): 
                     // $count=count($employees);
                     
                     foreach($no_docs_persons as $row):
                     ?>
                     <tr id="product_id_<?php echo $row->roleid;?>">
                        <td><?php echo $row->roleid;?></td>
                        <td><?php echo $row->roletype;?></td>
                        <td><?php echo $row->created;?></td>
                        <td><?php echo $row->updated;?></td>

                        <td>

               <?php  if ($accessarray[1] == 'Edit'):
               ?>
               <?php
                           foreach ($logo_data as $column1):
                                             // echo "<pre>";print_r($column);exit;
                              ?>
               <a  href="javascript:void(0)" data-id="<?php echo $row->roleid;?>" class="btn btn-<?= $column1['themecolor'] ?> show-user mb-2 edit-product">
               <i class="bi bi-pencil-square"></i></a>
               <?php endforeach; ?>

               <?php endif; ?>

               <?php            
                     //  echo "<pre>";
                     //  print_r($url);exit;
               if ($accessarray[2] == 'Delete'):       ?>

               <a href="javascript:void(0)" data-id="<?php echo $row->roleid;?>" class="btn btn-danger mb-2 delete-product">
               <i class="bi bi-trash3"></i></a>

               <?php endif; ?>

                        </td>
                     </tr>
                     <?php endforeach;?>
                     <?php endif; ?>
                  </tbody>
               </table>
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
                           <label for="name" class="col-sm-2 control-label">Role</label>
                           <div class="col-sm-12">
                              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Tilte"
                              value="" maxlength="50" required="">
                           </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                        <?php
                        foreach ($logo_data as $column1):
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
                    </div>

                </div>
        
            </div>
        
        </div>        
    </div>
    </div>


   
   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>


   </body> 
</html>
<script>
   var SITEURL = '<?php echo base_url(); ?>';  
          

   $(document).ready(function () {
 
   $("#product_list").DataTable();                      //loads product_list datatable
   
      /* When click delete button*/
      $('body').on('click', '.delete-product', function ()
            {
               var access_id = $(this).data("id");
               
               if (confirm("Are you sure want to delete ID:" +access_id))
               {
                  $.ajax({
                     type: "Post",
                     url: SITEURL + "dashboard/role_delete/"+access_id,
                     data:
                     {
                        product_id: access_id
                     },
                     dataType: "json",
                     success: function (data) {
                        $("#product_id_" + access_id).remove();
                        alert("User Record: " + access_id + " has been deleted successfully !");
                        logUserAction('Deleted the Record ID: ' + access_id, 'Role Menu', 'Details of the deleted record: ' + access_id);

                     },
                     error: function (data) {
                        console.log('Error:', data);
                     }
                  });
               }
            });

            /*  When click Add New button with id=create-new-product*/
 
      $('#create-new-product').click(function () {
            $('#btn-save').val("create-new-product");        //id btn-save selector with value create-new-product
            $('#product_id').val('');                        //set the input product_id field to empty if have any data
            $('#productForm').trigger("reset");              //reset the form fields
            $('#productCrudModal').html("Add New Role");  //set H4 heading to "Add New Product" of the Modal while pop up
            $('#ajax-product-modal').modal('show');          //Show the modal from with id=#ajax-product-modal

         });
 
     
      if ($("#productForm").length > 0)                     //checks form is greater than 0
      {
         
         $("#productForm").validate({

         submitHandler: function (form)
         {
            var actionType = $('#btn-save').val();          //method returns or sets the value attribute of the selected elements
            console.log(actionType);
            $('#btn-save').html('Sending..');               //set the button value to Sending..

            $.ajax({
               data: $('#productForm').serialize(),         //serialize() method creates a URL encoded text string by serializing form values
               url: SITEURL + (actionType === 'edit-product' ? 'dashboard/update_role' : 'dashboard/add_role'),              //set the site URL, here call to 'product' controller and then 'store' method 
               type: "POST",                                //form method type POST
               dataType: 'json',                            //transfer URL encoded text json type of data 
               success: function (res)
               {
                  
                  console.log(res);
                  //create the append child table row of data with the res
   		      var product = '<tr id="product_id_' + res.data.roleid + '"><td>'
               + res.data.roleid + '</td><td>' + res.data.roletype+ '</td><td>' + res.data.created + '</td><td>' + res.data.updated +'</td>';
 
               product += '<td><?php foreach ($logo_data as $column1):?><a href="javascript:void(0)" id="" data-id="' + res.data.roleid + '" class="btn btn-<?= $column1['themecolor'] ?> edit-product"><i class="bi bi-pencil-square"></i></a><?php endforeach; ?><a href="javascript:void(0)" id="" data-id="' + 				res.data.roleid + '" class="btn btn-danger delete-product"><i class="bi bi-trash3"></i></a></td></tr>';

                 if (actionType == "create-new-product") {
                   
                     $('#product_list').append(product);      //append data as the last child of the table
                     alert("Successfully Data Added!");
                     //call to loguserAction function for edit button
                     // logUserAction('Added the Record ID: ' + data.roleid, 'Role Menu', 'Details of the added record: ' + data.roletype);



                  } else {                                     // replace selected row with the updated data that stored in variable product
                     $("#product_id_" + res.data.roleid).replaceWith(product);
                     //call to loguserAction function for edit button
                  alert("Successfully Data Updated!");

                     setTimeout(function () {
            location.reload();
        }, 1000); 

                 }
 
                  $('#productForm').trigger("reset");             //reset form fields
                  $('#ajax-product-modal').modal('hide');         //hide the modal pop up window
                  $('#btn-save').html('Save Changes');            //change the button value
               },
               // error: function (res) {
               //    console.log('Error:', res);
               //    alert('Error:', res);

               //    $('#btn-save').html('Save Changes');
               // }
               error: function (res) {
                  console.log('Error Status:', res.status);
                     
                  // Check if the responseText is not empty
                  if (res.responseText.trim() !== '') {
                     console.log('Error Response:', res.responseText);
                     alert('Error:', res.responseText);
                  } else {
                     // If the responseText is empty, assume success
                     console.log('Success');
                  }

                  $('#btn-save').html('Save Changes');
               }
            });
         }
      })
   }

/* When click edit button with class="edit-product" */
 
$('body').on('click', '.edit-product', function () {
 
 var product_id = $(this).data("id");      //selected id value saved in variable product_id


 $.ajax({
    type: "Post",
    url: SITEURL + "dashboard/get_role_id",           
    data:
    {
        product_id: product_id
    },

    dataType: "json",
    success: function (data)
    {
        console.log(data);
        
        $('#productCrudModal').html("Edit Role");  //set H4 heading to "Add New Product" of the Modal while pop up
          $('#btn-save').val("edit-product");
          $('#ajax-product-modal').modal('show');
          $('#name').val(data.roletype);
          $('#product_id').val(data.roleid);
          logUserAction('Edited the Record ID: ' + data.roleid, 'Role Menu', 'Details of the edited record: ' + data.roletype);

        
                 
    },

    error: function (data)
    {
       console.log('Error:', data);
    }
 });
});


   }) 

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

