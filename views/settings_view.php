
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
    <div class="container table-container mb-2">
    <div class="row justify-content-center">
    <div class="col-md-8">
                
                    <?php if($this->session->flashdata('success')){ ?>
                <p class="text-success text-center"> <?=$this->session->flashdata('success') ?></p>
                <?php }?>
                

                <?php if($this->session->flashdata('error')){ ?>
                <p class="text-danger text-center"> <?=$this->session->flashdata('error') ?></p>
                <?php }?>

                <div class="card shadow">
                    <div class="card-header">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                    <?php foreach ($settings_data as $column):
                        $id=$column['dic_id']; ?>
                        <?php if ($id==3): ?>
                        <?php foreach ($logo_data as $column1): ?>
                                            <h4 class="text-right text-<?= $column1['themecolor'] ?>"><?= $column['pagehead'] ?></h4>
                        <?php endforeach; ?>

                        <?php endif; ?>

                        <?php endforeach; ?>
                    
                    </div>
                    </div>
                    <div class="card-body">
                       
                    <div class="d-flex justify-content-center text-center">

                    <div class="col-md-10 mb-3">
                    <?php echo form_error('name'); ?>
                    <select name="name" id="name" class="form-control">
                    <option name="page_wise_setting" value="">-- Choose Settings --</option>

                    <?php
                        foreach ($settings_data as $column):
                    ?>
                    <option name="page_wise_setting" value="<?php echo $column['pagehead']?>">
                    <?php echo $column['pagehead'];?>
                    
                    <?php endforeach; ?>
                    </option>                
                    </select>

                    </div>
                    </div>
                    <form method="post" action="<?= base_url('dashboard/updateSettings') ?>">
                        <div class="row justify-content-center">
                        <div class="col-md-10 mb-3">

                                <div class="card shadow" id="dynamicForm">
                                    
                                        <!-- Dynamic content will be added here based on the selected option -->
                                </div>

                            
                            </div>
                            </div>
                            
                            </div>


                        <div class="d-flex justify-content-center text-center">
                        <?php foreach ($logo_data as $column1): ?>
                                        <?php //change button names 
                                        foreach ($settings_data as $column):
                                        $id=$column['dic_id'];
                                        
                                        if ($id==3):         
                                        $tab_heads = $column['buttonhead'];
                                        
                                        $table_head = explode(', ', $tab_heads);
                                        ?>
                                        <button type="submit" class="btn btn-<?= $column1['themecolor'] ?> mt-2 mb-2"><?= $table_head[0] ?></button>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php endforeach; ?>

                        

                        </div>
                    </form>
                    
                    </div>

                </div>
        
            </div>
        
        </div>        
    </div>
    </div>

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('');?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        $('#name').change(function () {
            var selectedOption = $(this).val();
            updateDynamicForm(selectedOption);
        });

        function updateDynamicForm(selectedOption) {
            // Reset the dynamic form content
            $('#dynamicForm').html('');

            <?php foreach ($settings_data as $column): ?>
                <?php $id = $column['dic_id']; ?>

                    if (selectedOption === '<?= $column['pagehead'] ?>') {
                        // Add Access Page Settings form fields
                        $('#dynamicForm').append(`
                        <div class="card-header">
                        <?php foreach ($logo_data as $column1): ?>
                                <h5 class="form-group text-<?= $column1['themecolor'] ?>"><?= $column['pagehead'] ?></h5>
                            <?php endforeach; ?>
                            </div>
                            <div class="card-body">

                            <div class="form-group">
                                <label class="control-label" for="access_page_heading">Page Heading:</label><br>
                                <input type="hidden" class="form-control" id="access_page_heading" name="sections[<?= $id ?>][access_page_id]" value="<?= $column['dic_id'] ?>">

                                <input type="text" class="form-control" id="access_page_heading" name="sections[<?= $id ?>][access_page_heading]" value="<?= $column['pagehead'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="access_side_heading">Side Menu Heading:</label><br>
                                <input type="text" class="form-control" id="access_side_heading" name="sections[<?= $id ?>][access_side_heading]" value="<?= $column['sidehead'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="access_side_heading_user">Side Menu Heading for User:</label><br>
                                <input type="text" class="form-control" id="access_side_heading_user" name="sections[<?= $id ?>][access_side_heading_user]" value="<?= $column['sideheaduser'] ?>">
                            </div>
                            <div class="form-group">
                                    <label class="control-label" for="access_page_column">Table Heading:</label><br>

                            <?php
                            $tab_heads = $column['tablehead'];
                            $table_head = explode(', ', $tab_heads);
                            $counts = count($table_head);
                            for ($i = 0; $i < $counts; $i++) : ?>
                                    <input type="text" class="form-control mb-2" id="access_page_column_<?= $i ?>" name="sections[<?= $id ?>][access_page_columns][]" value="<?= $table_head[$i] ?>">
                            <?php endfor; ?>
                            </div>

                            <div class="form-group">

                            <label class="control-label" for="access_button_column">Button Heading:</label><br>

                            <?php
                            $tab_heads = $column['buttonhead'];
                            $table_head = explode(', ', $tab_heads);
                            $counts = count($table_head);
                            for ($i = 0; $i < $counts; $i++) : ?>

                                    <input type="text" class="form-control mb-2" id="access_button_column_<?= $i ?>" name="sections[<?= $id ?>][access_button_columns][]" value="<?= $table_head[$i] ?>">
                            <?php endfor; ?>
                            </div>

                            </div>
 `);                $('#dynamicForm').append(html);

                    }
            <?php endforeach; ?>

        }
    });
    

</script>
