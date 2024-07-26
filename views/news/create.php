
<?php echo validation_errors(); ?>
<div class="container justify-content-center">
<div class="row">
<div class="card-header"><h2><?php echo $title; ?></h2></div>
<div class="card border-primary mb-3">
<div class="mb-3">
<?php echo form_open('create'); ?>

    <label class="form-label" for="title">Title</label>
    <input class="form-control" type="text" name="title" /><br />
    <label class="form-label">Slug</label>
    <input class="form-control" type="text" name="slug" id ="slug" /><br/>
    <label class="form-label" for="text">Text</label>
    <textarea class="form-control" name="text"></textarea><br />
    

    <input class="btn btn-primary mb-3" type="submit" name="submit" value="Create news item" />

</div>
</div>
</div>
</div> 