



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php foreach ($news as $news_item): ?>
<div class="container-fluid justify-content-center">
<div class="row">
<div class="card border-primary mb-3">
<div class="card-header"><?php echo $news_item['slug']; ?></div>
<div class="card-body">
<h5 class="card-title"><?php echo $news_item['title']; ?></h5>
<p class="card-text"><?php echo $news_item['text']; ?></p>
<p class="card-text"><a href="<?php echo site_url('news/'.$news_item['slug']); ?>">View article</a></p>
<a href="<?php echo site_url('news/edit/'.$news_item['id']); ?>"><button class="btn btn-primary" type="submit">Edit</button></a>
<a href="<?php echo site_url('news/delete/'.$news_item['id']); ?>"><button class="btn btn-primary" type="submit">Delete</button></a>
</div>
</div>
</div>
</div>    
<?php endforeach; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
