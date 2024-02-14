<?php

namespace App\controller;

use App\services\IService;
use App\services\PostService;

class PostController extends BaseController
{
    public IService $postsService;

    public function __construct()
    {
        $this->postsService = new PostService();
    }

    public function handleRequest(): void
    {
        $operation = $_GET['action'] ?? null;
        $id = $_GET['id'] ?? null;

        switch ($operation){
            case null:
            case 'show':
                $this->show(); break;
            case 'add':
                $this->add(); break;
            case 'remove':
                $this->remove($id); break;
            case 'get':
                $this->get($id);break;
            case 'edit':
                $this->edit($id); break;
            case 'save':
                $this->show(); break;
            default:
                $this->showError("Wrong operation", "Page for operation '$operation' not found"); break;
        }
    }

    // Display a list of posts
    public function show()
    {
        $title = 'Posts';
        $posts = $this->postsService->getAllEntities();

        include('views/posts/posts.php');
    }

    // Add new post
    public function add()
    {
        $mode = 'add';
        $title = 'Add new post';
        include('views/posts/post.php');
    }

    // Edit a selected post
    public function edit(int $id)
    {
        $mode = 'edit';
        $title = 'Edit a post';
        $post = $this->postsService->getEntity($id);
        include('views/posts/post.php');
    }

    // Get a selected post
    public function get(int $id)
    {
        $mode = 'read';
        $title = '';
        $post = $this->postsService->getEntity($id);
        include('views/posts/post.php');
    }

    // Delete a selected post
    public function remove(int $id)
    {
        $this->postsService->removeEntity($id);
        $this->redirect("/?resource=posts");
    }
}
