<div class="card-body">

    <div class="mt-3 mb-3">
        <a href="<?= 'http://' . $_SERVER["SERVER_NAME"] . '/?resource=categories&id=' . $category->getId() . '&action=edit' ?>"
           class="btn action btn-secondary">Edit</a>
    </div>

    <table id="posts" class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Content</th>
            <th>Created at</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($category->getPosts() as $post) : ?>
            <tr>
                <td><?= $post->getId(); ?></td>
                <td><?= $post->getTitle(); ?></td>
                <td><?= mb_strlen($post->getContent()) > 255 ? mb_substr($post->getContent(), 0, 255) . '...' : $post->getContent() ?></td>
                <td><?= $post->getCreatedAt(); ?></td>
                <td>
                    <a href="<?= 'http://' . $_SERVER["SERVER_NAME"] . '/?resource=posts&id=' . $post->getId() . '&action=get' ?>"
                       class="btn action btn-secondary">Open</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
