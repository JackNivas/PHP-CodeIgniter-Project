
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"><!--For icons-->
    <title><?= $title ?></title>
</head>
<body>
    
    <?php if($this->session->flashdata('success')){ ?>
        <p class="text-success text-center"> <?=$this->session->flashdata('success') ?></p>
    <?php }?>

    <?php if($this->session->flashdata('error')){ ?>
        <p class="text-danger text-center"> <?=$this->session->flashdata('error') ?></p>
    <?php }?>
<div class="container table-container mb-4">
    <?php echo form_open_multipart('dashboard/themeUpdate'); ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                        <div class="card-header">
                        <?php
                        foreach ($logo_data as $column1):
                        ?>
                         <?php foreach ($settings_data as $column):
                     $id=$column['dic_id']; ?>
                    <?php if ($id==12): ?>
                        <h4 class="form-group text-<?= $column1['themecolor'] ?>" style="text-align:center;"><?= $column['pagehead'] ?></h4>

                        <?php endif; ?>

                        <?php endforeach; ?>
                        </div>

                    <div class="card-body">
                        <!-- Access Page Settings -->
                        <div class="form-group">
                            <label class="control-label" for="page_heading">Logo:</label><br>
                            <img class="rounded-circle  mt-1 mb-1" width="100px" src="<?php echo base_url('uploads/'.$column1['logoImage']); ?>"><br>
                            <!-- <img class="rounded-circle mt-1 mb-1" id="previewImage" width="100px" src="<?php echo base_url('uploads/'.$column1['logoImage']); ?>"><br> -->
                            <input type="hidden" class="form-control" id="previousimage" name="previousimage" value="<?= $column1['logoImage'] ?>">
                            <label class="control-label" for="page_heading">Choose Logo:</label><br>
                            <input type="file" name="userfiles" onchange="previewImage(this)" size="20" />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="side_heading">Logo Name:</label><br>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $column1['logoName'] ?>">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="copyYear">Copyright Year:</label><br>
                            <input type="text" class="form-control" id="copyYear" name="copyYear" value="<?= $column1['copyYear'] ?>">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="side_heading">Theme Color:</label><br>
                            <select name="logocolor" id="logocolor" class="form-control">
                                <option value="<?= $column1['themecolor'] ?>" selected><?= $column1['themecolor'] ?></option>
                                <option value="danger">Danger</option>
                                <option value="info">Info</option>
                                <option value="primary">Primary</option>
                                <option value="success">Success</option>
                                <option value="warning">Warning</option>
                            </select>
                        </div> 

                        <div class="d-flex justify-content-center text-center">
                        <?php foreach ($logo_data as $column1): ?>
                        <?php foreach ($settings_data as $column):
                           $id=$column['dic_id'];
                           
                           if ($id==12):  ?>
                        <button type="submit" class="btn btn-<?= $column1['themecolor'] ?>"><?= $column['buttonhead'] ?></button>

                        <?php endif; ?>

                        <?php endforeach; ?>
                  <?php endforeach; ?>
                        
                            <?php endforeach; ?>
                        </div> 
                                                
                    </div>

                </div>
            </div>
        
        </div>
        
    <?php form_close(); ?>
 
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</body>

    
</html>
<script>
    function previewImage(input) {
        var preview = document.getElementById('previewImage');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
</script>

