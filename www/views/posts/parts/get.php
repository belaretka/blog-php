<div class="card-body">
    <div class="row">
        <div class="col-8">
            <p>
                <?= $post->getContent(); ?>
            </p>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <div class="categories">
                        <?php if(count($post->getCategories()) === 0):?>
                            <span class="btn btn-dark btn-sm disabled">No category</span>
                        <?php else: ?>
                            <?php foreach($post->getCategories() as $cat) :?>
                                <span class="btn btn-dark btn-sm disabled"><?= $cat->getName(); ?></span>
                            <?php endforeach ?>
                        <?php endif;?>
                    </div>
                    </div>
                </div>
            </div>
        <div class="col-4">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Created at</h5>
                    <p class="card-text"><?= date('j M Y h:ia',  strtotime($post->getCreatedAt())) ?></p>
                </div>
            </div>
            <div class="mt-3">
                <a href="<?= 'http://' . $_SERVER["SERVER_NAME"] . '/?resource=posts&id=' . $post->getId() . '&action=edit' ?>"
                   type="submit" class="btn action btn-secondary btn-block">Edit</a>
            </div>
            <div class="mt-3">
                <a href="<?= 'http://' . $_SERVER["SERVER_NAME"] . '/?resource=posts' ?>" type="submit"
                   class="btn action btn-secondary btn-block">Back</a>
            </div>
        </div>
    </div>
</div>
