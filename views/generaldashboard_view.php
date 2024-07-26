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
<div class="container">
        <?php
            if($this->session->userdata('UserLoginSession'))
            {
                $udata=$this->session->userdata('UserLoginSession');
            }
            else
            {
                redirect(base_url('dashboard/login'));
            }
        ?>
                <?php foreach ($logo_data as $column1): ?>

                    <div class="align-items-left mb-3">
                        <h3 class="text-<?= $column1['themecolor'] ?>">Hi <?php echo $udata['name']; ?>!</h3>
                    </div>

                <?php endforeach; ?>

	<div class="col-md-12">
		<div class="row">

            <!-- <div class="col-md-4 mb-3">
            <div class="card bg-primary" style="width: 18rem;">
            <div class="card-body">
                <i class="bi bi-people" style="font-size: 30px; color:white;"></i>
                <h5 class="card-title" style="font-size: 20px; color:white;"><?php echo $all_records;?></h5>
                <h6 class="card-subtitle mb-2 text-body-secondary" >
                <a  href="<?php echo base_url('dashboard/viewusers');?>" style="font-size: 20px; color:white; padding:0px 0px;" class="nav-link">Total Persons</a></h6>
                
            </div>
            </div>
            </div> -->

            <div class="col-md-4 mb-3">
            <div class="card bg-primary" style="width: 18rem;">
            <div class="card-body">
                <i class="bi bi-people" style="font-size: 30px; color:white;"></i>
                <h5 class="card-title" style="font-size: 20px; color:white;"><?php echo $all_records;?></h5>
                <h6 class="card-subtitletext-body-secondary" >
                        
                <a  href="<?php echo base_url('dashboard/viewusers');?>" style="font-size: 20px; color:white; padding:0px 0px;" class="nav-link">Total Persons</a></h6>
                
            </div>
            </div>
            </div>
            
            <div class="col-md-4 mb-3">
            <div class="card bg-success" style="width: 18rem;">
            <div class="card-body">
                <i class="bi bi-person-square" style="font-size: 30px; color:white;"></i>
                <h5 class="card-title" style="font-size: 20px; color:white;"><?php echo $all_HR;?></h5>
                <h6 class="card-subtitletext-body-secondary" >
                <?php
           
                $udata=$this->session->userdata('UserLoginSession');
                $user_type=$udata['role'];
                $filterrole="HR";
                // echo "<pre>";
                // print_r($user_type);exit;?>
                <a  href="<?php echo base_url('dashboard/viewusers/'.$filterrole);?>" class="nav-link" style="font-size: 20px; color:white; padding:0px 0px;">Total HR</a>
                </h6>
                
            </div>
            </div>
            </div>
               
            <div class="col-md-4 mb-3">
            <div class="card bg-warning" style="width: 18rem;">
            <div class="card-body">
                <i class="bi bi-person-square" style="font-size: 30px; color:white;"></i>
                <h5 class="card-title" style="font-size: 20px; color:white;"><?php echo $inactive_persons;?></h5>
                <h6 class="card-subtitletext-body-secondary" >
                <?php
           
                  $udata=$this->session->userdata('UserLoginSession');
                  $user_type=$udata['role'];
                  $filterrole="Inactive";
                  // echo "<pre>";
                  // print_r($user_type);exit;?>
                  <a  href="<?php echo base_url('dashboard/viewusers/'.$filterrole);?>" class="nav-link" style="font-size: 20px; color:white; padding:0px 0px;">Inactive Users</a>                
            </div>
            </div>
            </div>
            
            

    	</div>
    </div>
</div>
    
<!-- Content Row -->

    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-md-6 mb-1">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="align-items-center">
                        <?php foreach ($logo_data as $column1): ?>
                            <h5 class="chart-title text-<?= $column1['themecolor'] ?>">Employee Count Bar Chart</h5>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="card-body">                     
                        <canvas id="bar"></canvas>
                    </div>

                </div>
        
            </div>

            <div class="col-md-6 mb-1">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="align-items-center">
                            <?php foreach ($logo_data as $column1): ?>
                                <h5 class="chart-title text-<?= $column1['themecolor'] ?>">Employee Count Pie Chart</h5>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <div class="card-body">                    
                        <canvas id="pie"></canvas>
                    </div>

                </div>
        
            </div>
                <div class="col-md-12 mb-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-center align-items-center">
                                <?php foreach ($logo_data as $column1): ?>
                                <h5 class="chart-title text-<?= $column1['themecolor'] ?>">Employee Count Line Chart</h5>
                                <?php endforeach; ?>
                            </div>
                        </div>
                            
                        <div class="card-body">                    
                            <canvas id="line" height="100"></canvas>
                        </div>

                    </div>
        
                </div>
                <div class="col-md-12 mb-1">
                <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-center align-items-center">
                            <?php foreach ($logo_data as $column1): ?>
                            <h5 class="chart-title text-<?= $column1['themecolor'] ?>">Employee Listing</h5>
                            <?php endforeach; ?>
                            </div>
                        </div>
                            
                        <div class="card-body">                    
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
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($dashboardFive): 
                                
                                foreach($dashboardFive as $row):
                                
                                

                                ?>
                                <tr id="product_id_<?php echo $row->id;?>">
                                <!-- <td><?php echo $row->id;?></td> -->
                                <td><?php echo $row->name;?></td>
                                <td><?php echo $row->email;?></td>
                                <td><?php echo $row->role;?></td>

                                <td><?php echo $row->status;?></td>
                                <td style="width: 10%;"><img class="img-profile rounded-circle" style="width:50%; height:40%;" src="<?php echo base_url('uploads/'.$row->profpic); ?>"/></td>
                                <!-- <td>
                                    
                                    <?php echo $row->filesdoc;?><br>

                                </td> -->
                                <?php 
                                $date= new DateTime($row->datecreateon);
                                $date1= new DateTime($row->dateupdatedon);
                                $date1->format('d-M-Y h:i:s a')
                                ?>
                                <td><?php echo $date->format('j-M-Y h:i:s a');?></td>
                                
                                </tr>
                                <?php endforeach;?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php
                            foreach ($logo_data as $column1):
                            ?>
                        <a  href="<?php echo base_url('dashboard/viewusers');?>" class="btn btn-<?= $column1['themecolor'] ?> show-user mb-2">For More Rows</a>
                        <?php endforeach; ?>
                        </div>

                </div>
        
            </div>
        </div>

        

    </div>
        


</div>

<?php
           
                $udata=$this->session->userdata('UserLoginSession');
                $user_type=$udata['role'];
                // echo "<pre>";
                // print_r($user_type);exit;

           
        ?>
                 <input type="hidden" id="id_data" name="fileter_HR" value="<?php echo $user_type;?>" />


<div class="container-fluid">

      

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    </body>

    <script>
    const baseUrl = "<?php echo base_url();?>";

    const generateChart = (chartType, chartData, chartTitle) => {
        const ctx = document.getElementById(chartType).getContext('2d');
        const config = {
            type: chartType,
            data: chartData,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: chartTitle,
                    },
                },
            },
        };

        new Chart(ctx, config);
    };

    const fetchDataAndGenerateCharts = () => {
        $.ajax({
            url: baseUrl + 'dashboard/generaldashchart', // Update the URL to match your controller function
            dataType: 'json',
            method: 'get',
            success: data => {
                if (data && Array.isArray(data) && data.length > 0) {
                    const chartX = data.map(item => item.role);
                    const chartY = data.map(item => item.total);

                    const colors = [
                        'palegreen',
                        'blue',
                        'green',
                        'pink',
                        'orange',

                        // Add more colors as needed
                    ];

                    const chartData = {
                        labels: chartX,
                        datasets: [{
                            label: 'Total',
                            data: chartY,
                            backgroundColor: colors.slice(0, chartX.length),
                            // borderColor: 'white', // Set a common border color if needed
                            borderWidth: 2,
                        }],
                    };

                    generateChart('bar', chartData);
                    generateChart('line', chartData);
                    generateChart('pie', chartData);
                } else {
                    console.error('Invalid or empty data received:', data);
                }
            },
            error: (xhr, status, error) => {
                console.error('Error fetching data:', status, error);
                console.log('Server response:', xhr.responseText);
            }
        });
    };

    // Call the function to fetch data and generate charts
    fetchDataAndGenerateCharts();
</script>

</html>