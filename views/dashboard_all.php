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
<div class="container-fluid mb-2">
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
                    <?php foreach ($settings_data as $column):
                     $id=$column['dic_id']; ?>
                    <?php if ($id==2): ?>
                     <?php foreach ($logo_data as $column1): ?>
                     <h4 class="text-right text-<?= $column1['themecolor'] ?>"><?= $column['pagehead'] ?></h4>
                     <?php endforeach; ?>

                        <?php endif; ?>

                        <?php endforeach; ?>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="<?php echo base_url('dashboard/detailed_excel_import'); ?>" enctype="multipart/form-data" id="frm_filters" method="post" name="frm_import">
                                    <div class="form-group">
                                        <input class="col-md-6" type="file" name="userfile" />
                                        <?php foreach ($logo_data as $column1): ?>
                                        <?php //change button names 
                                        foreach ($settings_data as $column):
                                        $id=$column['dic_id'];
                                        
                                        if ($id==2):         
                                        $tab_heads = $column['buttonhead'];
                                        
                                        $table_head = explode(', ', $tab_heads);
                                        ?>
                                            <input type="submit"  class="btn btn-<?= $column1['themecolor'] ?> ml-1" id="customExportButton"  value="<?= $table_head[1] ?>">

                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php endforeach; ?>

                                    </div>
                            </form>
                            
                            </div>
                            <div class="col-md-2 left">
                            <form action="<?php echo base_url('dashboard/detailed_excel_export'); ?>" id="frm_filters" method="post" name="frm_filters">
                                <div class="form-group">
                                
                                <?php
                                foreach ($logo_data as $column1):
                                ?>
                                <?php //change button names 
                                foreach ($settings_data as $column):
                                $id=$column['dic_id'];
                                
                                if ($id==2):         
                                $tab_heads = $column['buttonhead'];
                                
                                $table_head = explode(', ', $tab_heads);
                                ?>
                                    <input type="submit"  class="btn btn-<?= $column1['themecolor'] ?> ml-1" id="customExportButton"  value="<?= $table_head[0] ?>">

                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                                
                                <?php
                                            foreach ($logo_data as $column):
                                        ?>
                                    <?php endforeach; ?>

                                </div>
                            </form>
                        </div>
                        
                        </div>
                    </div>

                <div class="container-fluid">

                <table class="table table-bordered table-striped" id="product_list">
                    <thead>
                        <tr>
                        <!-- <th>ID</th> -->
                        <?php foreach ($settings_data as $column):
                           $id=$column['dic_id'];
                           
                           if ($id==2):         
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
                    <?php if($all_details): 
                        // $count=count($employees);
                        
                        foreach($all_details as $row):
                        ?>
                        <tr>
                            <td><?php echo $row->name;?></td>
                            <td><?php echo $row->email;?></td>
                            <td><?php echo $row->role;?></td>
                            <td><?php echo $row->status;?></td>               
                            <td><?php echo $row->accesstypes;?></td>
                            <td><?php echo $row->accessbutton;?></td>
                            <td><?php echo $row->doc_name;?></td>
                            <?php 
                            if ($row->datecreateon !== null) {
                                $date = new DateTime($row->datecreateon);
                                $formattedDate = $date->format('j-M-Y h:i:s a');
                            } else {
                                // Handle the case where $row->datecreated is null
                                $formattedDate = 'N/A';
                            }               
                            ?>
                        <td><?php echo $formattedDate; ?></td>
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
</div>
   
        

  <!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('');?>assets/vendor/jquery/jquery.min.js"></script>
<!-- <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

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