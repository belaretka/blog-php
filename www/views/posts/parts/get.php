<div class="card-body">
    <form >
        <div class="form-group">
            <h3>Post title</h3>
            <input readonly type="text" class="form-control" value="abc">
        </div>
        <div class="form-group">
            <h3>Created at</h3>
            <input readonly type="date" class="form-control" value="abc">
        </div>
        <div class="form-group">
            <h3>Categories</h3>
            <select multiple class="form-control" id="categories">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="form-group">
            <h3>Post Content</h3>
            <textarea class="form-control" id="content" rows="5" value="<?= $post->getContent(); ?>"></textarea>
        </div>
        <a href="<?= 'http://'.$_SERVER["SERVER_NAME"].'/?resource=posts&action=save'?>" type="submit" class="btn btn-primary btn-block">Submit</a>
    </form>
</div>
