
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
<div class="d-flex justify-content-center align-items-center mb-3">
   <?php  foreach ($logo_data as $column1): ?>

<h4 class="text-right text-<?= $column1['themecolor'] ?>">User Listing</h4>
<?php endforeach; ?>
</div>
<?php
           
                $udata=$this->session->userdata('UserLoginSession');
                $user_type=$udata['role'];
                // echo "<pre>";
                // print_r($user_type);exit;

           
        ?>
                 <input type="hidden" id="id_data" value="<?php echo $user_type;?>" />


<div class="container">
      <table class="table table-bordered table-striped" id="product_list">
         <thead>
            <tr>
               <!-- <th>ID</th> -->
               <th>Name</th>
               <th>Email</th>
               <th>Role</th>
               <th>Status</th>
               <th>Profile Pic</th>
               <!-- <th>Added Documents</th> -->
               <th>Registered Date</th>
               <!-- <th>Updated Date</th> -->
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
               <tr>
               <!-- <td><?php echo $row->id;?></td> -->
               <td><?php echo $roleuser->name;?></td>
               <td><?php echo $roleuser->email;?></td>
               <td><?php echo $roleuser->role;?></td>

               <td><?php echo $roleuser->status;?></td>
               <td><img class="img-profile rounded-circle" style="width:20%; height:20%;" src="<?php echo base_url('uploads/'.$roleuser->profpic); ?>"/></td>
               
               <?php 
               $date= new DateTime($roleuser->datecreateon);
               $date1= new DateTime($roleuser->dateupdatedon);
               $date1->format('j-M-Y h:i:s a')
               ?>
               <td><?php echo $date->format('j-M-Y h:i:s a');?></td>
               <td>
               <?php  foreach ($logo_data as $column1): ?>

                  <a  href="javascript:void(0)" data-id="<?php echo $roleuser->id;?>" class="btn btn-<?= $column1['themecolor'] ?> show-user"><i class="bi bi-binoculars"></i></a>
                  <!-- <br/><a id="user-hide" href="javascript:void(0)"  data-id="<?php echo $roleuser->id;?>" class="btn btn-primary edit-product"><i class="bi bi-pencil-square"></i></a> -->
                  <!-- <a id="user-hide" href="javascript:void(0)" data-id="<?php echo $roleuser->id;?>" class="btn btn-danger delete-product"><i class="bi bi-trash3"></i></a> -->
                  <?php endforeach; ?>

               </td>
            </tr>
            
         </tbody>
      </table>
   </div>
 <!-- Model for add edit product -->

 <div class="modal fade" id="ajax-product-modal" aria-hidden="true">

<div class="modal-dialog">
   <div class="modal-content">

      <div class="modal-header">
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
               <label class="col-sm-2 control-label">Email</label>
               <div class="col-sm-12">
                  <input type="text" class="form-control" id="email" name="email"
                   placeholder="Enter Description" value="" required="">
               </div>
            </div>
            
            <div class="form-group">
               <label class="col-sm-2 control-label">Role</label>
               <div class="col-sm-12">
                  <input type="text" class="form-control" id="role" name="role"
                   placeholder="Enter Description" value="" required="">
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
               <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes</button>
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

            <div class="modal-header">
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
            <div class="modal-footer">
            </div>
         </div>

      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   </body> 
</html>
<script>
   var SITEURL = '<?php echo base_url(); ?>';  
          

   $(document).ready(function () {
 
      $("#product_list").DataTable();                      //loads product_list datatable

      /*  When click Add New button with id=create-new-product*/
 
      $('#create-new-product').click(function () {
            $('#btn-save').val("create-new-product");        //id btn-save selector with value create-new-product
            $('#product_id').val('');                        //set the input product_id field to empty if have any data
            $('#productForm').trigger("reset");              //reset the form fields
            $('#productCrudModal').html("Add New Product");  //set H4 heading to "Add New Product" of the Modal while pop up
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
                + res.data.status + '</td><td><img class="img-profile rounded-circle" style="width:50%; height:40%;" src="<?php echo base_url('uploads/'); ?>"/>' + res.data.profpic + '</td><td>' + res.data.datecreateon + '</td>';
 
               product += '<td><?php foreach ($logo_data as $column1): ?><a href="javascript:void(0)" id="" data-id="' + res.data.id + '" class="btn btn-<?= $column1['themecolor'] ?> edit-product"><i class="bi bi-pencil-square"></i></a><?php endforeach; ?><a href="javascript:void(0)" id="" data-id="' + 				res.data.id + '" class="btn btn-danger delete-product"><i class="bi bi-trash3"></i></a></td></tr>';
                 
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
          $('#userCrudModal').html("View User Details");//heading changed to Edit Product of the Modal
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
         //  $('#documents').html(res.data.filesdoc);

          

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
            success: function (res)
            {
               if (res.success == true) {

                  $('#productCrudModal').html("Edit User Details");//heading changed to Edit Product of the Modal
                  $('#btn-save').val("edit-product");
                  $('#ajax-product-modal').modal('show');
                  $('#product_id').val(res.data.id);
                  $('#name').val(res.data.name);
                  $('#email').val(res.data.email);
                  $('#role').val(res.data.role);
                  $('#status').val(res.data.status);
                  $('#profpic').val(res.data.profpic);
                  // $('#filesdoc').val(res.data.filesdoc);

                  

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

               },
               error: function (data) {
                  console.log('Error:', data);
               }
            });
         }
      });
   })   

</script>