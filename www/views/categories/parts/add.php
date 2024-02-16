<div class="card-body">
    <form method="POST" action="/?resource=categories&action=save">
        <div class="form-group">
            <h3>Category Name</h3>
            <input type="text" class="form-control" placeholder="Category Name" id="name" name="name">
        </div>
        <div class="form-group">
            <h3>Posts</h3>
            <select multiple class="form-control" id="posts" name="posts[]">
                <?php foreach ($allPosts as $post): ?>
                    <option value="<?= $post->getId(); ?>">
                        <?= $post->getTitle(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
</div>

