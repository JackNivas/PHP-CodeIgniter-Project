
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
    <link href="<?php echo base_url('');?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('');?>assets/css/sb-admin-2.min.css" rel="stylesheet">
<style>
/* Add this style in your CSS or in a style tag in the HTML file */

.modal-body {
    Width: 1200;
    height: 400px;
    margin: auto;
    text-align:center;

}    
</style>


</style>
</head>

<body id="page-top">

<div class="d-flex justify-content-center align-items-center mb-3">
    <?php
    foreach ($logo_data as $column1):
    ?>
   <h4 class="text-right text-<?= $column1['themecolor'] ?>">Employee Documents Listing</h4>
   <?php endforeach; ?>
</div>
<?php
            if($this->session->userdata('UserLoginSession'))
            {
                $udata=$this->session->userdata('UserLoginSession');
            }
            else{
                redirect(base_url('dashboard/login'));
                }
        ?>

<div class="container rounded bg-white mt-5 mb-5">
    
        <div class="col-md-9 border-right">
            <div class="p-3 py-5">

              
                <div class="row mt-3">
                    <div class="col-md-12 mb-2">
                    <h4 class="nav-link">Documents of <?php echo $docs_by_id->username;?></h4></div>

                    <div class="container">
                        <table class="table table-bordered table-striped" id="product_list">
                            <thead>
                               
                                <tr>
                                <!-- <th>ID</th> -->
                                <th>Document Name</th>
                                <th>Updated Date</th>
                                <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $files[]=$docs_by_id->doc_name;
                                $filename_string = implode(', ', $files);

                                $stringfiles=explode(',', $filename_string);
                                $counts=count($stringfiles);

                                $stringfiles=explode(',', $filename_string);

                                $i=0;
                                for($i=0; $i<$counts; $i++){
                                    
                                    
                            ?>
                            <tr>       
                            <td><?php echo $stringfiles[$i];?></td>
                            <td><?php echo $docs_by_id->dateupdated;?></td>

                            
                            <td><?php $file[$i]=trim($stringfiles[$i]); 
                            ?>
                            <!-- <a  href="<?php echo base_url('uploads/'.$file[$i])?>" class="btn btn-primary show-user" target="_blank"><i class="bi bi-binoculars"></i></a> -->
                            <?php $file[$i] = trim($stringfiles[$i]); ?>
                            <?php
                            foreach ($logo_data as $column1):
                            ?>
                            <a href="#" class="btn btn-<?= $column1['themecolor'] ?> show-document" data-docname="<?php echo $file[$i]; ?>"><i class="bi bi-binoculars"></i></a>

                            <a  href="<?php echo base_url('dashboard/download/'.$file[$i])?>" class="btn btn-<?= $column1['themecolor'] ?> show-user"><i class="bi bi-download"></i></a>
                            <?php endforeach; ?>
                            </td>

                            </tr>
                            <?php 
                                }
                            ?>
                            </tbody>
                        </table>

                    </div>
                    <?php
                            foreach ($logo_data as $column1):
                            ?>
                            <a class="btn btn-<?= $column1['themecolor'] ?> ml-4" href="<?php echo base_url('dashboard/documents');?>">Back</a>
                            <?php endforeach; ?>

                    
                    <div class="dropdown-divider"></div>
                    
                    
                <?php
                                    if($this->session->flashdata('error')){ ?>
                                    <p class="text-danger text-center"> <?=$this->session->flashdata('error') ?>
                                    </p><?php }?>
                                    <?php form_close(); ?>
                </div>
            </div>
        
        </div>
        <div class="container">
    <div class="modal fade" style="top: 6%; left: 2%;"  id="documentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel">
    <div class="modal-dialog modal-fixed" role="document"> <!-- Add a custom class for fixed width -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel">Document Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="customCloseButton">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content will be loaded here via AJAX -->
                <div id="documentImageContainer" class="d-flex justify-content-center align-items-center">
                    
                    <img id="documentImage" style="max-width: 80%; max-height: 80%;" src="">
                </div>
            </div>
        </div>
    </div>
</div>
</div>




        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <!-- Bootstrap core JavaScript-->
 <script src="<?php echo base_url('');?>assets/vendor/jquery/jquery.min.js"></script>
 <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

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


<script>
//     $(document).ready(function () {
//     $('.show-document').click(function () {
//         var docName = $(this).data('docname');

//         // Make an AJAX request to fetch content
//         $.ajax({
//             url: '<?php echo base_url('dashboard/load_document_content'); ?>',
//             type: 'POST',
//             data: { docName: docName },
//             success: function (data) {
//                 console.log(data);

//                 // Open the PDF content in a new window
//                 var pdfWindow = window.open('', '_blank');
//                 pdfWindow.document.write('<html><head><title>' + docName + '</title></head><body><embed width="100%" height="100%" type="application/pdf" src="data:application/pdf;base64,' + data + '"></body></html>');
//             },
//             error: function () {
//                 console.log('Error loading document content');
//             }
//         });
//     });
// });
// $(document).ready(function () {
//     $('.show-document').click(function () {
//         var docName = $(this).data('docname');

//         // Make an AJAX request to fetch content
//         $.ajax({
//             url: '<?= base_url('dashboard/load_document_content') ?>',

//             type: 'POST',
//             data: { docName: docName },
//             success: function (data) {
//                 console.log(data);

//                 // Check the file extension to determine the content type
//                 var extension = docName.split('.').pop().toLowerCase();

//                 if (extension === 'pdf') {
//                     // Open the PDF content in a new window
//                     var pdfWindow = window.open('', '_blank');
//                     pdfWindow.document.write('<html><head><title>' + docName + '</title></head><body><embed width="100%" height="100%" type="application/pdf" src="data:application/pdf;base64,' + data + '"></body></html>');
//                 } else if (['png', 'jpg', 'jpeg', 'gif'].includes(extension)) {
//                     // Display the image in a modal
//                     // $('#documentModal .modal-body').html('<img style="width: auto; height: auto; max-height: auto; max-width: auto; margin: auto;" src="data:image/' + extension + ';base64,' + data + '" alt="' + docName + '">');
//                     // $('#documentModal').modal('show');
//                     // Assuming 'data' contains the base64-encoded image data
//             var image = new Image();
//             image.src = 'data:image/' + extension + ';base64,' + data;

//             // Wait for the image to load
//             image.onload = function() {
//                 // Get the dimensions of the image
//                 var imageWidth = this.width;
//                 var imageHeight = this.height;

//                 // Set the maximum dimensions for the modal
//                 var maxWidth = $(window).width() * 0.8; // Adjust as needed
//                 var maxHeight = $(window).height() * 0.8; // Adjust as needed

//                 // Calculate the new dimensions while maintaining the aspect ratio
//                 var newWidth = Math.min(imageWidth, maxWidth);
//                 var newHeight = Math.min(imageHeight, maxHeight);

//                 // Update the modal body with the image and set its size
//                 $('#documentModal .modal-body').html('<img style="width: ' + newWidth + 'px; height: ' + newHeight + 'px; max-width: 100%; max-height: 100%; margin: auto;" src="data:image/' + extension + ';base64,' + data + '" alt="' + docName + '">');

//                 // Set the modal size based on the image size
//                 $('#documentModal .modal-dialog').css({
//                     'width': newWidth + 'px',
//                     'height': newHeight + 'px',
//                     'max-width': 'none',
//                     'max-height': 'none'
//                 });

//                 // Show the modal
//                 $('#documentModal').modal('show');
//             };

//                 } else {
//                     // Unsupported file type
//                     console.log('Unsupported file type');
//                 }
//             },
//             error: function () {
//                 console.log('Error loading document content');
//             }
//         });
//     });
// });
$(document).ready(function () {
    $('.show-document').click(function () {
        var docName = $(this).data('docname');

        // Make an AJAX request to fetch content
        $.ajax({
            url: '<?= base_url('dashboard/load_document_content') ?>',
            type: 'POST',
            data: { docName: docName },
            success: function (data) {
                console.log(data);

                // Check the file extension to determine the content type
                var extension = docName.split('.').pop().toLowerCase();

                if (extension === 'pdf') {
                    // Open the PDF content in a new window
                    var pdfWindow = window.open('', '_blank');
                    pdfWindow.document.write('<html><head><title>' + docName + '</title></head><body><embed width="100%" height="100%" type="application/pdf" src="data:application/pdf;base64,' + data + '"></body></html>');
                } else if (['png', 'jpg', 'jpeg', 'gif'].includes(extension)) {
                    // Display the image in a modal
                    var image = new Image();
                    image.src = 'data:image/' + extension + ';base64,' + data;

                    // Wait for the image to load
                    image.onload = function () {
                        // Set the fixed size for the modal dialog
                        var fixedWidth = 1100; // Adjust this value as needed
                        var fixedHeight = 400; // Adjust this value as needed

                        // Update the modal body with the image and set its size
                        $('#documentModal .modal-body').html('<img style="width: 100%; height: 100%;" src="data:image/' + extension + ';base64,' + data + '" alt="' + docName + '">');

                        // Set the fixed size for the modal dialog
                        $('#documentModal .modal-dialog').css({
                            'width': fixedWidth + 'px',
                            'height': fixedHeight + 'px',
                            'max-width': 'none',
                            'max-height': 'none'
                        });
                        $('#documentModal').on('show.bs.modal', function () {
                            $(this).find('.modal-dialog').addClass('modal-fixed');
                        });

                        // Show the modal
                        $('#documentModal').modal('show');
                    };
                } else {
                    // Unsupported file type
                    console.log('Unsupported file type');
                }
            },
            error: function () {
                console.log('Error loading document content');
            }
        });
    });
});

$(document).ready(function () {
        // Attach a click event listener to the custom close button
        $('#customCloseButton').click(function () {
            // Close the modal
            $('#documentModal').modal('hide');
        });
    });
  
</script>

