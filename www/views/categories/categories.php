<?php include('views/template/header.php'); ?>

<div class="container-fluid">

    <section class="card mt-3 mb-3">
        <a href="<?= 'http://' . $_SERVER["SERVER_NAME"]?>"
           class="btn action btn-secondary col">Back</a>
        <header class="card-header">
            <h1 class="mb-0"><?= htmlentities($title); ?></h1>
        </header>

        <div class="mx-auto mt-3">
            <a href="<?= 'http://' . $_SERVER["SERVER_NAME"] . '/?resource=categories&action=add' ?>"
               class="btn action btn-secondary col">Add new</a>
        </div>

        <div class="card-body">

            <table id="categories" class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Category name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?= $category->getId(); ?></td>
                        <td><?= $category->getName(); ?></td>
                        <td>
                            <a href="<?= 'http://' . $_SERVER["SERVER_NAME"] . '/?resource=categories&id=' . $category->getId() . '&action=get' ?>"
                               class="btn action btn-secondary">Open</a>
                            <a href="<?= 'http://' . $_SERVER["SERVER_NAME"] . '/?resource=categories&id=' . $category->getId() . '&action=edit' ?>"
                               class="btn action btn-secondary">Edit</a>
                            <a href="<?= 'http://' . $_SERVER["SERVER_NAME"] . '/?resource=categories&id=' . $category->getId() . '&action=remove' ?>"
                               class="btn action btn-secondary">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <?php include('views/template/footer.php'); ?>
