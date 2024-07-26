

<html>
    <style>
        #footer {
        position:absolute;
        bottom:0;
        padding-bottom:8px;
        left:50%;
        justify-content:center;
        /* width:82%;
        height:60px; Height of the footer
        background:#6cf; */
        }
        
        .img-profile1 {
            width: 25px; /* Adjust the width as per your preference */
            height: 25px; /* Adjust the height as per your preference */
            object-fit: cover; /* This property controls how the image is resized within its container */
            /* Add any additional styling for the image */
        }

        .rounded-circle1 {
            border-radius: 50%; /* This creates a circular shape for the image */
        }
    </style>
    <!-- Custom fonts for this template-->
<link href="<?php echo base_url('');?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('');?>assets/css/sb-admin-2.min.css" rel="stylesheet">
<body>

    

<!-- Footer -->
        <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div id="footer" class="copyright text-center my-auto">
                    <?php
                    foreach ($logo_data as $column):
                                    // echo "<pre>";print_r($column);exit;
                        ?>
                        <span>Copyright &copy; <img class="img-profile1 rounded-circle1" src="<?php echo base_url('uploads/'.$column['logoImage']); ?>" alt="logo"> <?= $column['logoName'] ?> <?= $column['copyYear'] ?></span>
                        <?php endforeach; ?>
                </div>
                </div>
</footer>
<!-- End of Footer -->
</div>

</div>
<script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>
