<?php

namespace App\controller;

use App\model\DTO\PostDTO;
use App\services\CategoryService;
use App\services\IService;
use App\services\PostService;

class PostController extends BaseController implements IResourceController
{
    const PAGINATION = 5;

    public IService $postService;
    public IService $categoryService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->categoryService = new CategoryService();
    }

    public function handleRequest(): void
    {
        $operation = $_GET['action'] ?? null;
        $post_id = $_GET['id'] ?? null;
        $page = $_GET['page'] ?? 1;

        switch ($operation) {
            case null:
            case 'show':
                $this->display($page);
                break;
            case 'add':
                $this->create();
                break;
            case 'remove':
                $this->remove($post_id);
                break;
            case 'get':
                $this->get($post_id);
                break;
            case 'edit':
                $this->edit($post_id);
                break;
            case 'save':
                $this->save();
                break;
            case 'update':
                $this->update($post_id);
                break;
            default:
                $this->showError("Wrong operation", "Page for operation '$operation' not found");
                break;
        }
    }

    public function display(int $page)
    {
        $title = 'Posts';
        $postsAmount = $this->postService->countPosts();
        $pagesAmount = ceil($postsAmount / self::PAGINATION);

        $posts = $this->postService->getPostsPerPage($page, self::PAGINATION);

        include('views/posts/posts.php');
    }

    public function create()
    {
        $mode = 'add';
        $title = 'Add new post';

        $categories = $this->categoryService->getAll();

        include('views/posts/post.php');
    }

    public function remove(int $id)
    {
        $this->postService->removeInstance($id);
        $this->redirect("/?resource=posts");
    }

    public function get(int $id)
    {
        $post = $this->postService->getInstance($id);

        $mode = 'get';
        $title = $post->getTitle();

        include('views/posts/post.php');
    }

    public function edit(int $id)
    {
        $mode = 'edit';
        $title = 'Edit a post';

        $post = $this->postService->getInstance($id);
        $allCategories = $this->categoryService->getAll();

        include('views/posts/post.php');
    }

    public function save()
    {
        $categories = $_POST['categories'] ?? null;
        $this->postService->saveInstance(new PostDTO (
            null,
            date('y-m-d h:m:s', time()),
            $_POST['title'],
            $_POST['content'],
            $categories));
        $this->redirect("/?resource=posts");
    }

    public function update(int $id)
    {
        $this->postService->updateInstance(new PostDTO(
            $id,
            $_POST['created_at'],
            $_POST['title'],
            $_POST['content'],
            $_POST['categories']));
        $this->redirect("/?resource=posts&id={$id}&action=get");
    }
}
