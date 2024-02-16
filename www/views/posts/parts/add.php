<div class="card-body">
    <form method="POST" action="/?resource=posts&action=save">
        <div class="form-group">
            <h3>Post title</h3>
            <input type="text" class="form-control" placeholder="Post Title" id="title" name="title">
        </div>
        <div class="form-group">
            <h3>Categories</h3>
            <select multiple class="" id="categories" name="categories[]">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->getId(); ?>">
                        <?= $category->getName(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <h3>Post Content</h3>
            <textarea class="form-control" id="content" name="content" rows="15" placeholder="Add content"></textarea>
        </div>
        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
</div>

