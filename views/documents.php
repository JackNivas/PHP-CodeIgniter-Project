
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
<div class="container-fluid mb-3">
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
                    <?php 
                    foreach ($settings_data as $column):
                     $id=$column['dic_id'];
                     if ($id==7):  ?>
                        <?php
                        foreach ($logo_data as $column1):
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
                        // echo "<pre>";
                        // print_r($user_type);exit;
                        ?>
                        <input type="hidden" id="id_data" value="<?php echo $user_type;?>" />
                        <?php if($this->session->flashdata('success')){ ?>
                        <p class="text-success text-center"> <?=$this->session->flashdata('success') ?></p>
                        <?php }?>

                        <?php if($this->session->flashdata('error')){ ?>
                        <p class="text-danger text-center"> <?=$this->session->flashdata('error') ?></p>
                        <?php }?>
                        <div class="container">
                        <div class="row">
                        <div class="col-md-12">
                            <form action="<?php echo base_url('dashboard/createexceldocument'); ?>" id="frm_filters" method="post" name="frm_filters">
                                <div class="form-group">
                                    <label for="filter_title"><b>Filter</b></label>
                                    
                                    
                                        <input type="text" name="filter_title" id="filter_title" class="col-md-7" maxlength="128" minlength="1">
                                        <?php
                                    foreach ($logo_data as $column1):
                                    ?>
                                    <?php //change button names 
                                        foreach ($settings_data as $column):
                                            $id=$column['dic_id'];
                                            
                                            if ($id==7):         
                                            $tab_heads = $column['buttonhead'];
                                        
                                            $table_head = explode(', ', $tab_heads);
                                            ?>
                                    <input type="submit" name="frm-filter-btn" id="frm-filter-btn" class="col-md-2 btn-<?= $column1['themecolor'] ?>" value="<?= $table_head[1] ?>">
                                    <input type="submit"  class="btn btn-<?= $column1['themecolor'] ?> ml-2" id="customExportButton"  value="<?= $table_head[2] ?>">
                                    <a href="javascript:void(0)"  class="btn btn-<?= $column1['themecolor'] ?> ml-2 create-pdf" name="create-pdf" id="create-pdf"><?= $table_head[3] ?></a>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php endforeach; ?>
                                    <!-- <a href="<?php echo base_url('dashboard/createpdfdocument'); ?>" class="btn btn-primary ml-2" id="create-pdf">PDF</a> -->

                                </div>
                            </form>
                           
                            <form method="post" action="<?= base_url('dashboard/importdocuments') ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input class="col-md-2" type="file" name="userfile" />
                                    <?php
                                    foreach ($logo_data as $column1):
                                    ?>
                                    <?php //change button names 
                                    foreach ($settings_data as $column):
                                    $id=$column['dic_id'];
                                    
                                    if ($id==7):         
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
                        
                        

                            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('dashboard/someMethod'); ?>">
                                
                                <input type="submit" class="btn btn-<?= $column1['themecolor'] ?> ml-2" value="Transfer File" />
                            </form>
                        <hr>
                        <div class="container">
                            <?php
                            foreach ($logo_data as $column1):
                            ?>
                                    <?php //change button names 
                                    foreach ($settings_data as $column):
                                        $id=$column['dic_id'];
                                        
                                        if ($id==7):         
                                        $tab_heads = $column['buttonhead'];
                                    
                                        $table_head = explode(', ', $tab_heads);
                                        ?>
                                        <a href="<?php echo base_url('dashboard/multipleuploads'); ?>" class="btn btn-<?= $column1['themecolor'] ?> ml-3" id="create-new-product"><?= $table_head[0] ?></a>

                                        <?php endif; ?>
                                        <?php endforeach; ?>
                            <?php endforeach; ?>

                        <br><br>
                        <table class="table table-bordered table-striped" id="docs_list">
                            <thead>
                            <tr>
                                <!-- <th>Name</th>
                                
                                <th>Added Documents</th>
                                <th>Updated Date</th>
                                <th>Actions</th> -->
                                <?php foreach ($settings_data as $column):
                                $id=$column['dic_id'];
                                
                                if ($id==7):         
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
                        <?php if($employees_files): 
                        // $count=count($employees);
                            
                        foreach($employees_files as $row):
                        ?>
                        <input type="hidden" name="filter_title" value="<?php echo $row->fileid;?>" id="filter_title" class="col-md-8" maxlength="128" minlength="1">

                        <tr id="product_id_<?php echo $row->fileid;?>">
                            <td><?php echo $row->username;?></td>
                            <td><?php echo $row->doc_name;?></td>
                            
                            <?php 
                            $date= new DateTime($row->datecreated);
                            $date1= new DateTime($row->dateupdated);
                            $date1->format('j-M-Y h:i:s a');
                            ?>
                            <!-- <td><?php echo $date->format('j-M-Y \ h:i:s a');?></td> -->
                            <td><?php echo $date1->format('j-M-Y \ h:i:s a');?></td>

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
                                <?php
                                foreach ($logo_data as $column1):
                                ?>
                                <a  href="<?php echo base_url('dashboard/get_user_by_docs_id/'.$row->fileid);?>" data-id="<?php echo $row->fileid;?>" class="btn btn-<?= $column1['themecolor'] ?> show-user">
                                <i class="bi bi-binoculars"></i></a>
                                <?php endforeach; ?>
                                
                                <?php            
                            // $url=base_url('dashboard/documentsuploadview');
                                    //  echo "<pre>";
                                    //  print_r($url);exit;
                            if ($accessarray[1] == 'Edit'):       ?>
                                <?php
                                foreach ($logo_data as $column1):
                                ?>
                                <a id="user-hide" href="<?php echo base_url('dashboard/get_user_by_docs_edit_id/'.$row->fileid);?>"  data-id="<?php echo $row->fileid;?>" class="btn btn-<?= $column1['themecolor'] ?> edit-product">
                                <i class="bi bi-pencil-square"></i></a>
                                <?php endforeach; ?>

                                <?php endif; ?>
                                <?php            
                            // $url=base_url('dashboard/accessperuser');
                                    //  echo "<pre>";
                                    //  print_r($url);exit;
                            if ($accessarray[2] == 'Delete'):       ?>
                            <a id="user-hide" href="javascript:void(0)" data-id="<?php echo $row->fileid;?>" class="btn btn-danger delete-product">
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
    </div>
</div>

 
   

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   <!-- <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
   <!-- Include SheetJS (js-xlsx) -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

   </body> 
</html>
<script>
   var SITEURL = '<?php echo base_url(); ?>'; 
         
   
          
   

        $('#frm-filter-btn').on("click", function() {
            event.preventDefault();

            var table = $('#docs_list');


            $.ajax({
                url: "<?= base_url('dashboard/get_by_filtersdoc') ?>",
                dataType: 'JSON',
                method: 'POST',
                data: {
                    'filter_news_title': $('#filter_title').val()
                },
                success: function(data_return) {

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
                                "data": "username"
                            },
                            
                            {
                                "data": "doc_name"
                            },
                           
                            {
                                "data": "dateupdated"
                            },

                            {
                                "data": null
                            },
                        ],
                        columnDefs: [{
                            // # hide the first column
                            // https://datatables.net/examples/advanced_init/column_render.html                    
                            "targets": [0],
                            "width": 70
                            // "visible": false
                        },
                        {
                            // # disable search for column number 2
                            // https://datatables.net/reference/option/columns.searchable                    
                            "targets": [1],
                            "searchable": false,
                            // # disable orderable column
                            // https://datatables.net/reference/option/columns.orderable
                            "orderable": false,
                            "width": 70
                        },
                    
                    
                    {
                                    "targets": [2],
                                    "render": function(data, type, row, meta) {
                                        $controlls = '<?php echo $date1->format('j-M-Y h:i:s a');?>';
                                        return $controlls;
                                    },
                                        "width": 100
                    },
                        {
                            // # action controller (edit,delete)
                            "targets": [3],
                            // # column rendering
                            // https://datatables.net/reference/option/columns.render
                            "render": function(data, type, row, meta) {
                                $controlls = '<a  href="<?php echo base_url('dashboard/get_user_by_docs_id/'.$id="' + row.fileid + '");?>" data-id="' + row.fileid + '" class="btn btn-info show-user ml-1"><i class="bi bi-binoculars"></i></a><a id="user-hide" href="javascript:void(0)"  data-id="' + row.fileid + '" class="btn btn-info edit-product ml-1"><i class="bi bi-pencil-square"></i></a><a id="user-hide" href="javascript:void(0)" data-id="' + row.fileid + '" class="btn btn-danger delete-product ml-1"><i class="bi bi-trash3"></i></a>';
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


       



//Datatable to store data
   $(document).ready(function () {
 
      $("#docs_list").DataTable();                      //loads docs_list datatable

      
     
      


      
      /* When click delete button*/

      $('body').on('click', '.delete-product', function ()
      {
         var product_id = $(this).data("id");

         if (confirm("Are you sure want to delete ID:" +product_id))
         {
            $.ajax({
               type: "Post",
               url: SITEURL + "dashboard/deletefiles",
               data:
               {
                  product_id: product_id
               },
               dataType: "json",
               success: function (data) {
                  $("#product_id_" + product_id).remove();
                  alert("User Record: " + product_id + " has been deleted successfully !");
                  logUserAction('Deleted the Record ID: ' + product_id, 'Documents Menu', 'Details of the deleted record: ' + product_id);


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
               url: "<?= base_url('dashboard/createpdfdocument') ?>",
                dataType: 'JSON',
                method: 'POST',
                data: {
                  'filter_news_title': $('#filter_title').val()
                },
        success: function(response) {

            // Check if the response indicates success
            if (response.success) {

                var fileName = response.fileName;
                

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
                alert('Error generating PDF. Please try again.');

            }
        },
        error: function(xhr, status, error) {
            // Handle AJAX errors if needed
            console.error('AJAX Error:', status, error);
                        
            // Log the response text for further investigation
            console.log('Response Text:', xhr.responseText);
            alert('An error occurred. Please try again later.');


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