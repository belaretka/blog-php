<div class="card-body">
    <form method="POST" action="<?= '/?resource=posts&id=' . $post->getId() . '&action=update' ?>">
        <div class="form-group">
            <h3>Post title</h3>
            <input type="text" class="form-control" id="title" name="title" value="<?= $post->getTitle(); ?>">
        </div>
        <div class="form-group">
            <h3>Created at</h3>
            <input type="datetime-local" class="form-control" id="created_at" name="created_at"
                   value="<?= $post->getCreatedAt(); ?>">
        </div>
        <div class="form-group">
            <h3>Categories</h3>
            <select multiple class="form-control" id="categories" name="categories[]">
                <?php foreach ($allCategories as $category): ?>
                    <?php if (array_key_exists($category->getId(), $post->getCategories())): ?>
                        <option selected value="<?= $category->getId(); ?>">
                            <?= $category->getName(); ?>
                        </option>
                    <?php else: ?>
                        <option value="<?= $category->getId(); ?>">
                            <?= $category->getName(); ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <h3>Post Content</h3>
            <textarea class="form-control" id="content" name="content" rows="15"><?= $post->getContent(); ?></textarea>
        </div>
        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
</div>
