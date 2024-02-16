<?php include('views/template/header.php'); ?>

<div class="container">

    <div class="row mt-5 mb-1">
        <div class="col">
            <h1 class="text-align-center"><?= htmlentities($title); ?></h1>
        </div>
    </div>

    <div class="row mb-1">
        <div class="col"></div>
        <div class="col">
            <a href="<?= 'http://'.$_SERVER["SERVER_NAME"].'/?resource=posts'?>" class="btn btn-secondary">Posts</a>
        </div>
        <div class="col"></div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <a href="<?= 'http://'.$_SERVER["SERVER_NAME"].'/?resource=categories'?>" class="btn btn-secondary">Categories</a>
        </div>
        <div class="col"></div>
    </div>

    <?php include('views/template/footer.php'); ?>

