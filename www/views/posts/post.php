<?php include('views/template/header.php'); ?>

<div class="container">

    <div class="row justify-content-start">
        <div class="col-auto mt-3">
            <a href="<?= 'http://' . $_SERVER["SERVER_NAME"] . '/?resource=posts&action=show' ?>"
               class="btn action btn-secondary col">Back</a>
        </div>
    </div>

    <section class="card mt-3 mb-3">

        <header class="card-header">
            <h1 class="mb-0"><?= htmlentities($title); ?></h1>
        </header>

        <?php
        switch ($mode) {
            case 'edit':
                include('views/posts/parts/edit.php');
                break;
            case 'get':
                include('views/posts/parts/get.php');
                break;
            case 'add':
                include('views/posts/parts/add.php');
                break;
        }
        ?>
    </section>

    <?php include('views/template/footer.php'); ?>
