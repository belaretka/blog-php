<?php include('views/template/header.php'); ?>

<div class="container-fluid">

    <section class="card mt-3 mb-3">
        <header class="card-header">
            <h1 class="mb-0"><?= htmlentities($title); ?></h1>
        </header>
        <div>
            <a href="<?= 'http://'.$_SERVER["SERVER_NAME"].'/?resource=posts'?>" class="btn btn-secondary">Posts</a>
        </div>
        <div>
            <a href="<?= 'http://'.$_SERVER["SERVER_NAME"].'/?resource=categories'?>" class="btn btn-secondary">Categories</a>
        </div>
    </section>

    <?php include('views/template/footer.php'); ?>

