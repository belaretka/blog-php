<?php include('views/template/header.php'); ?>

<div class="container-fluid">

    <section class="card mt-3 mb-3">
        <a href="<?= 'http://' . $_SERVER["SERVER_NAME"]?>"
           class="btn action btn-secondary col">Back</a>
        <header class="card-header">
            <h1 class="mb-0"><?= htmlentities($title); ?></h1>
        </header>

        <div class="mx-auto mt-3">
            <a href="<?= 'http://'.$_SERVER["SERVER_NAME"].'/?resource=posts&action=add'?>" class="btn action btn-secondary col">Add new</a>
        </div>

        <div class="card-body">

            <table id="posts" class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td><?= $post->getId(); ?></td>
                        <td><?= $post->getTitle(); ?></td>
                        <td><?= mb_substr($post->getContent(), 0, 255) . '...'; ?></td>
                        <td><?= $post->getCreatedAt(); ?></td>
                        <td>
                            <a href="<?= 'http://'.$_SERVER["SERVER_NAME"].'/?resource=posts&id=' . $post->getId() . '&action=get'?>" class="btn action btn-secondary">Open</a>
                            <a href="<?= 'http://'.$_SERVER["SERVER_NAME"].'/?resource=posts&id=' . $post->getId() . '&action=edit'?>" class="btn action btn-secondary">Edit</a>
                            <a href="<?= 'http://'.$_SERVER["SERVER_NAME"].'/?resource=posts&id=' . $post->getId() . '&action=remove'?>" class="btn action btn-secondary">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </section>



    <?php include('views/template/footer.php'); ?>
