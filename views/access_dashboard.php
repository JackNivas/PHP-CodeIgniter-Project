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
      #contain-change{
         padding-left:1.5rem;
         padding-right:1.5rem;
      }
   </style>
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('');?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

   <body id="page-top">
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

                <div class="card shadow">
                    <div class="card-header">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                    <?php foreach ($settings_data as $column):
                     $id=$column['dic_id']; ?>
              
                     <?php if ($id==1): ?>
                     <?php foreach ($logo_data as $column1): ?>
                        <h4 class="text-right text-<?= $column1['themecolor'] ?>"><?= $column['pagehead'] ?></h4>
                     <?php endforeach; ?>

                     </div>
                     <?php endif; ?>

                     <?php endforeach; ?>
                    
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
   
    
                  <?php            
                  // $url=base_url('dashboard/accessperuser');
                        //  echo "<pre>";
                        //  print_r($url);exit;
                  if ($accessarray[0] == 'Add'):       ?>
                  <?php
                              foreach ($logo_data as $column1):
                                                // echo "<pre>";print_r($column);exit;
                  ?>
                        <?php foreach ($settings_data as $column):
                           $id=$column['dic_id'];
                           
                           if ($id==1):  ?>    
                           <a href="<?php echo base_url('dashboard/accessperuser');?>" class="btn btn-<?= $column1['themecolor'] ?> ml-3" id="create-new-product"><?= $column['buttonhead'] ?></a>
                        <?php endif; ?>

                        <?php endforeach; ?>
                  <?php endforeach; ?>


                  <?php endif; ?>
                  <br><br>
                  <table class="table table-bordered table-striped" id="product_list">
                     <thead>
                        <tr>
                           <!-- <th>ID</th> -->
                           <!-- <th>Name</th>
                           <th>Access Menus</th>
                           <th>Access Buttons</th>
                           <th>Actions</th> -->
                           <?php foreach ($settings_data as $column):
                           $id=$column['dic_id'];
                           
                           if ($id==1):         
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
                           $access=$row->accesstypes;
                           $straccess=explode(',', $access);

                        ?>
                        <tr id="product_id_<?php echo $row->accessid;?>">
                           <td><?php echo $row->username;?></td>
                           <td><?php echo trim($row->accesstypes);?></td>
                           <td><?php echo $row->accessbutton;?></td>
                           <td>

                  <?php            
                  $url=base_url('dashboard/accessedit/'.$row->userid);
                        //  echo "<pre>";
                        //  print_r($url);exit;
                  if ($accessarray[1] == 'Edit'):
                  ?>
               <?php
                              foreach ($logo_data as $column1):
                                                // echo "<pre>";print_r($column);exit;
                        ?>
                  <a  href="<?php echo base_url('dashboard/accessedit/'.$row->userid);?>" class="btn btn-<?= $column1['themecolor'] ?> show-user mb-2">
                  <i class="bi bi-pencil-square"></i></a>
                  <?php endforeach; ?>

                  <?php endif; ?>

                  <?php            
                  $url=$row->accessid;
                        //  echo "<pre>";
                        //  print_r($url);exit;
                  if ($accessarray[2] == 'Delete'):       ?>
                  
                  <a href="javascript:void(0)" data-id="<?php echo $row->accessid;?>" class="btn btn-danger mb-2 delete-product">
                  <i class="bi bi-trash3"></i></a>
                  
                  <?php endif; ?>

                           </td>
                        </tr>
                        <?php endforeach;?>
                        <?php endif; ?>
                     </tbody>
                  </table>
                    
                    
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
   
      /* When click delete button*/
      $('body').on('click', '.delete-product', function ()
            {
               var access_id = $(this).data("id");
               
               if (confirm("Are you sure want to delete ID:" +access_id))
               {
                  $.ajax({
                     type: "Post",
                     url: SITEURL + "dashboard/accessdelete/"+access_id,
                     data:
                     {
                        product_id: access_id
                     },
                     dataType: "json",
                     success: function (data) {
                        $("#product_id_" + access_id).remove();
                        alert("User Record: " + access_id + " has been deleted successfully !");
                        logUserAction('Deleted the Record ID: ' + access_id, 'Access Menu', 'Details of the deleted record: ' + access_id);


                     },
                     error: function (data) {
                        console.log('Error:', data);
                     }
                  });
               }
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

