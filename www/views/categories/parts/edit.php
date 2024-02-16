<div class="card-body">
    <form method="POST" action="<?= '/?resource=categories&id=' . $category->getId() . '&action=update'?>">
        <div class="form-group">
            <h3>Category Name</h3>
            <input type="text" class="form-control" value="<?= $category->getName() ?>" id="name" name="name">
        </div>
        <div class="form-group">
            <h3>Posts</h3>
            <select multiple class="form-control" id="posts" name="posts[]">
                <?php foreach ($allPosts as $post): ?>
                    <?php if (array_key_exists($post->getId(), $category->getPosts())): ?>
                        <option selected value="<?= $post->getId(); ?>">
                            <?= $post->getTitle(); ?>
                        </option>
                    <?php else: ?>
                        <option value="<?= $post->getId(); ?>">
                            <?= $post->getTitle(); ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
</div>
