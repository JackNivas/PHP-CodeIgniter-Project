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
   <!-- Custom fonts for this template-->
   <link href="<?php echo base_url('');?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">

   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style type="text/css">
      .error{
      color: red;
      }
      .date-filter-form {
        border: 1px solid #ccc; /* Add a border with a color of your choice */
        padding: 15px; /* Add some padding for better visual appearance */
        border-radius: 5px; /* Optional: Add rounded corners */
    }

    @media (max-width: 575.98px) {
    .col-sm-6,
    .col-md-4,
    .col-md-2 {
        width: 100%; /* Full width on small screens */
        margin-bottom: 10px; /* Add some spacing between stacked elements */
    }
}

/* Medium devices (tablets, 768px and up) */
@media (min-width: 576px) and (max-width: 767.98px) {
    .col-sm-6 {
        width: 50%; /* Two columns per row on medium screens */
    }

    .col-md-4,
    .col-md-2 {
        width: 100%; /* Full width on medium screens */
        margin-bottom: 10px; /* Add some spacing between stacked elements */
    }
}

/* Large devices (desktops, 992px and up) */
@media (min-width: 768px) and (max-width: 991.98px) {
    .col-md-4,
    .col-md-2 {
        width: 50%; /* Two columns per row on large screens */
    }

    .col-sm-6 {
        width: 100%; /* Full width on large screens */
        margin-bottom: 10px; /* Add some spacing between stacked elements */
    }
}
      
   </style>
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('');?>assets/css/sb-admin-2.min.css" rel="stylesheet">



    
</head>

   <body id="page-top">
   <div class="container-fluid table-container mb-2">
   <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card shadow">
                    <div class="card-header">
                    <div class="d-flex justify-content-center align-items-center mb-3">

                    <?php foreach ($settings_data as $column):
                        $id=$column['dic_id']; ?>
                        <?php if ($id==4): ?>
                        <?php foreach ($logo_data as $column1): ?>
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

    <div class="row mb-2">
    <div class="col-md-6">
    <div class="row  date-filter-form">

    <div class="col-md-4  col-sm-6 mt-2 mb-1">
    <form action="" id="frm_filters" method="post" name="frm_filters">
        <?php echo form_error('name'); ?>
        <select name="name" id="name" class="form-control select2">
            <option value="All" selected>Select Name</option>
            <?php if ($emp_list) :
                foreach ($emp_list as $row) :
                    $chosenUser_id = $row->name;
            ?>
                    <option value="<?php echo $chosenUser_id; ?>" id="<?php echo $row->id; ?>">
                        <?php echo $row->name; ?>
                    </option>
            <?php
                endforeach;
            endif;
            ?>
        </select>
    </form>

    </div>

    <div class="col-md-4  col-sm-6 mt-2 mb-1">
    <form action="" id="action_filters" method="post" name="action_filters">
        <?php echo form_error('name'); ?>
        <select name="action" id="action" class="form-control select2">
            <option value="All" selected>Select Action</option>
            <option value="Added">Added</option>
            <option value="Edited">Edited</option>
            <option value="Deleted">Deleted</option>
        </select>
    </form>
    </div>


    <div class="col-md-4  col-sm-6 mt-2 mb-1">
    <form action="" id="menu_filters" method="post" name="menu_filters">
        <?php echo form_error('name'); ?>
        <select name="menu_wise" id="menu_wise" class="form-control select2">
            <option value="All" selected>Select Menu</option>
            <option value="Access Menu">Access Menu</option>
            <option value="Documents Menu">Documents Menu</option>
            <option value="Employee Menu">Employee Menu</option>
            <option value="HR Menu">HR Menu</option>
            <option value="Manager Menu">Manager Menu</option>
            <option value="Role Menu">Role Menu</option>
        </select>
    </form>
    </div>


        </div>
        </div>


    <!-- <div class="col-md-2 mb-4">
        <label class="labels" for="datepicker">Date:</label>
        <input type="text" name="selected_date" id="datepicker" placeholder="Select date" class="form-control" autocomplete="off" />
    </div> -->
    <div class="col-md-6">
    <div class="container  date-filter-form ">

    <form action="" id="date_filters" method="post" name="date_filters">

    <div class="row">
        <div class="col-md-3 col-sm-6">
            <input type="text" name="from_date" id="datepicker1" placeholder="From Date" class="form-control date-input" autocomplete="off" />
        </div>
        <div class="col-md-3 col-sm-6">
            <input type="text" name="to_date" id="datepicker2" placeholder="To Date" class="form-control date-input" autocomplete="off" />
        </div>
        
        <?php foreach ($logo_data as $column1): ?>
        <?php //change button names 
        foreach ($settings_data as $column):
        $id=$column['dic_id'];
        
        if ($id==4):         
        $tab_heads = $column['buttonhead'];
        
        $table_head = explode(', ', $tab_heads);
        ?>
        <div class="col-md-3 col-sm-6">

       
        <input type="submit" name="date-filter-btn" id="date-filter-btn" class="form-control btn-<?= $column1['themecolor'] ?>" value="<?= $table_head[0] ?>">

                                        
        </div>
            <div class="col-md-3 col-sm-6">
            <button type="button" name="reset-btn" id="reset-btn" class="form-control btn-<?= $column1['themecolor'] ?>" onclick="resetForm()"><?= $table_head[1] ?></button>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endforeach; ?>

    </div>

    </form>

    </div>


</div>

</div>


      <table class="table table-bordered table-striped" id="product_list">
         <thead>
            
            <tr>
            <?php foreach ($settings_data as $column):
                           $id=$column['dic_id'];
                           
                           if ($id==4):         
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
         <?php if($employees): 
            // $count=count($employees);
              
            foreach($employees as $i=>$row):
            //       echo "<pre>";
            //  print_r($count);exit;
               
            ?>
            <tr id="product_id_<?php echo $row['user_id'];?>">
            <td><?php echo $i + 1; ?></td> <!-- Increment $i to start from 1 -->
               <td><?php echo $row['user_name'];?></td>
               <td><?php echo $row['action'];?></td>
               <td><?php echo $row['menu_item'];?></td>
               <td><?php echo $row['additional_info'];?></td>
               <?php 
               $date= new DateTime($row['timestamp']);
               ?>
               <td><?php echo $date->format('j-M-Y \ h:i:s a');?></td>


               <!-- <td>

      <?php            
      $url=base_url('dashboard/accessedit/'.$row->userid);
            //  echo "<pre>";
            //  print_r($url);exit;
      if ($accessarray[1] == 'Edit'):
      ?>
   
      <a  href="<?php echo base_url('dashboard/accessedit/'.$row->userid);?>" class="btn btn-primary show-user mb-2">
      <i class="bi bi-pencil-square"></i></a>
   
      <?php endif; ?>

      <?php            
      $url=$row->accessid;
            //  echo "<pre>";
            //  print_r($url);exit;
      if ($accessarray[2] == 'Delete'):       ?>
      
      <a href="javascript:void(0)" data-id="<?php echo $row->accessid;?>" class="btn btn-danger mb-2 delete-product">
      <i class="bi bi-trash3"></i></a>
      
      <?php endif; ?>

               </td> -->
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
   <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Include the Select2 JS file -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

   </body> 
</html>
<script>
   var SITEURL = '<?php echo base_url(); ?>';  
   function resetForm() {
    // Reset the form fields in date filter form
    var dateForm = document.getElementById('date_filters');
    dateForm.reset();

    // Reset the form fields in other forms
    document.getElementById('menu_filters').reset();
    document.getElementById('action_filters').reset();
    document.getElementById('frm_filters').reset();

    // Reset the Select2 dropdowns and set their values to "All"
    $('#menu_wise').val('All').trigger('change');
    $('#action').val('All').trigger('change');
    $('#name').val('All').trigger('change');
}



   $(document).ready(function () {
 
   $("#product_list").DataTable();                      //loads product_list datatable
   
    //   /* When click delete button*/
    //   $('body').on('click', '.delete-product', function ()
    //         {
    //            var access_id = $(this).data("id");
               
    //            if (confirm("Are you sure want to delete ID:" +access_id))
    //            {
    //               $.ajax({
    //                  type: "Post",
    //                  url: SITEURL + "dashboard/accessdelete/"+access_id,
    //                  data:
    //                  {
    //                     product_id: access_id
    //                  },
    //                  dataType: "json",
    //                  success: function (data) {
    //                     $("#product_id_" + access_id).remove();
    //                     alert("User Record: " + access_id + " has been deleted successfully !");

    //                  },
    //                  error: function (data) {
    //                     console.log('Error:', data);
    //                  }
    //               });
    //            }
    //         });

   })


   $(document).ready(function () {
      // Initialize Select2 on the name and action dropdowns
      $('.select2').select2();
   });


   

    $(document).ready(function () {
      // Initialize date picker
      $("#datepicker1").datepicker({
        dateFormat: 'yy-mm-dd', // Specify the date format
        showButtonPanel: true,   // Show the button panel for easier navigation
        changeMonth: true,       // Allow changing the month
        changeYear: true,        // Allow changing the year
        
      });
    });
    $(document).ready(function () {
      // Initialize date picker
      $("#datepicker2").datepicker({
        dateFormat: 'yy-mm-dd', // Specify the date format
        showButtonPanel: true,   // Show the button panel for easier navigation
        changeMonth: true,       // Allow changing the month
        changeYear: true,        // Allow changing the year
        
      });
    });
//filter by names
$(document).ready(function () {
$('#name').on("change", function () {
    var selectedUserName  = $(this).val();

    // Check if a user is selected
    if (selectedUserName  !== '') {
        var table = $('#product_list');

        $.ajax({
            url: "<?= base_url('dashboard/get_by_filter_logs') ?>",
            dataType: 'JSON',
            method: 'POST',
            data: {
                'filter_user_name': selectedUserName
            },
            success: function (data_return) {
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
                        // drawCallback: function (settings) {
                        //     // Format the timestamp in the "timestamp" column after each draw
                        //     var api = this.api();
                        //     api.rows().every(function () {
                        //         var data = this.data();
                        //         var timestamp = new Date(data.timestamp);
                        //         var formattedDate = timestamp.toLocaleString(); // You can customize the format here
                        //         api.cell(this, 5).data(formattedDate); // Assuming "timestamp" is the 6th column (index 5)
                        //     });
                        // },
                        data: data_return,
                        columns: [
                            {
                                "data": null,
                                "render": function (data, type, row, meta) {
                                    // Use meta.row to get the row index and add 1 to start from 1
                                    return meta.row + 1;
                                }
                            },
                            
                            {
                                "data": "user_name"
                            },
                           
                            {
                                "data": "action"
                            },

                            {
                                "data": "menu_item"
                            },

                           {
                              "data": "additional_info"
                           },

                           {
                              "data": "timestamp"
                           },
                        ],
                        columnDefs: [
                            {
                            // # hide the first column
                            // https://datatables.net/examples/advanced_init/column_render.html                    
                            "targets": [0],
                            "width": 50,
                            "orderable": true

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
                            "width": 120
                        },
                        
                        {
                            // # disable search for column number 2
                            // https://datatables.net/reference/option/columns.searchable                    
                            "targets": [2],
                            "searchable": false,
                            // # disable orderable column
                            // https://datatables.net/reference/option/columns.orderable
                            "orderable": false,

                            "width": 100
                        }
                        ],
                        // #set order descending and ascending
                        // https: //datatables.net/reference/option/order
                        "order": [
                            [0, 'asc'],
                            [1, 'desc'],
                            [2, 'asc']
                        ]
                    });
            }
        });
    }
});
})

   //filter by names
$(document).ready(function () {
$('#action').on("change", function () {
    var selectedUserName  = $(this).val();

    // Check if a user is selected
    if (selectedUserName  !== '') {
        var table = $('#product_list');

        $.ajax({
            url: "<?= base_url('dashboard/get_by_filter_logs') ?>",
            dataType: 'JSON',
            method: 'POST',
            data: {
                'filter_user_name': selectedUserName
            },
            success: function (data_return) {
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
                                "data": null,
                                "render": function (data, type, row, meta) {
                                    // Use meta.row to get the row index and add 1 to start from 1
                                    return meta.row + 1;
                                }
                            },
                            
                            {
                                "data": "user_name"
                            },
                           
                            {
                                "data": "action"
                            },

                            {
                                "data": "menu_item"
                            },

                           {
                              "data": "additional_info"
                           },

                           {
                              "data": "timestamp"
                           },
                        ],
                        columnDefs: [{
                            // # hide the first column
                            // https://datatables.net/examples/advanced_init/column_render.html                    
                            "targets": [0],
                            "width": 50,
                            "orderable": false

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
                            "width": 120
                        },
                        
                        {
                            // # disable search for column number 2
                            // https://datatables.net/reference/option/columns.searchable                    
                            "targets": [2],
                            "searchable": false,
                            // # disable orderable column
                            // https://datatables.net/reference/option/columns.orderable
                            "orderable": false,

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
    }
});
});

   $(document).ready(function () {
$('#menu_wise').on("change", function () {
    var selectedUserName  = $(this).val();

    // Check if a user is selected
    if (selectedUserName  !== '') {
        var table = $('#product_list');

        $.ajax({
            url: "<?= base_url('dashboard/get_by_filter_logs') ?>",
            dataType: 'JSON',
            method: 'POST',
            data: {
                'filter_user_name': selectedUserName
            },
            success: function (data_return) {
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
                                "data": null,
                                "render": function (data, type, row, meta) {
                                    // Use meta.row to get the row index and add 1 to start from 1
                                    return meta.row + 1;
                                }
                            },
                            
                            {
                                "data": "user_name"
                            },
                           
                            {
                                "data": "action"
                            },

                            {
                                "data": "menu_item"
                            },

                           {
                              "data": "additional_info"
                           },

                           {
                              "data": "timestamp"
                           },
                        ],
                        columnDefs: [{
                            // # hide the first column
                            // https://datatables.net/examples/advanced_init/column_render.html                    
                            "targets": [0],
                            "width": 50,
                            "orderable": false

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
                            "width": 120
                        },
                        
                        {
                            // # disable search for column number 2
                            // https://datatables.net/reference/option/columns.searchable                    
                            "targets": [2],
                            "searchable": false,
                            // # disable orderable column
                            // https://datatables.net/reference/option/columns.orderable
                            "orderable": false,

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
    }
});
   });
   
//filter by Date range
$(document).ready(function () {
    $('#date_filters').on("submit", function (event) {
        // Prevent the default form submission
        event.preventDefault();

        var fromDate = $('#datepicker1').val();
        var toDate = $('#datepicker2').val();

        // Check if both from and to dates are selected
        if (fromDate !== '' && toDate !== '') {
            var table = $('#product_list');

            $.ajax({
                url: "<?= base_url('dashboard/get_by_filter_logs_date') ?>",
                dataType: 'JSON',
                method: 'POST',
                data: {
                    'from_date': fromDate,
                    'to_date': toDate
                },
                success: function (data_return) {
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
                                "data": null,
                                "render": function (data, type, row, meta) {
                                    // Use meta.row to get the row index and add 1 to start from 1
                                    return meta.row + 1;
                                }
                            },
                            
                            {
                                "data": "user_name"
                            },
                           
                            {
                                "data": "action"
                            },

                            {
                                "data": "menu_item"
                            },

                           {
                              "data": "additional_info"
                           },

                           {
                              "data": "timestamp"
                           },
                        ],
                        columnDefs: [{
                            // # hide the first column
                            // https://datatables.net/examples/advanced_init/column_render.html                    
                            "targets": [0],
                            "width": 50,
                            "orderable": true

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
                            "width": 120
                        },
                        
                        {
                            // # disable search for column number 2
                            // https://datatables.net/reference/option/columns.searchable                    
                            "targets": [2],
                            "searchable": false,
                            // # disable orderable column
                            // https://datatables.net/reference/option/columns.orderable
                            "orderable": false,

                            "width": 100
                        },
                        
                        
                        {
                            // # disable search for column number 2
                            // https://datatables.net/reference/option/columns.searchable                    
                            "targets": [5],
                            "searchable": false,
                            // # disable orderable column
                            // https://datatables.net/reference/option/columns.orderable
                            "orderable": true,

                            "width": 100
                        },
                    
                        ],
                        // #set order descending and ascending
                        // https: //datatables.net/reference/option/order
                        "order": [
                            [0, 'asc'],
                            [1, 'asc'],
                            [2, 'asc'],
                           

                        ]
                    });
                }
            });
        }
    });
});


</script>

