

<?php echo validation_errors(); ?>
<div class="container justify-content-center">
<div class="row">
<div class="card-header"><h2><?php echo $title; ?></h2></div>
<div class="card border-primary mb-3">
<div class="mb-3">
    <?php echo form_open('update/'.$news['id']); ?>

    <label class="form-label"> ID </label>
    <input class="form-control" type="text" name="id" id="id" value = "<?php echo $news['id']; ?>" /><br/>
    
    <label class="form-label">Title</label>
    <input class="form-control" type="text" name="title" id ="name" value = "<?php echo $news['title'];?>" /><br/>
    
    <label class="form-label">Slug</label>
    <input class="form-control" type="text" name="slug" id ="slug" value="<?php echo $news['slug'];?>" /><br/>
    
    <label class="form-label">Text</label>
    <textarea class="form-control" type="textarea" name="text" id ="text" value = ""><?php echo $news['text'] ;?></textarea><br/>
    
    <input class="btn btn-primary mb-3"  type="submit" name="update" value="Update" />

</div>
</div>
</div>
</div> 