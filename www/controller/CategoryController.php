<?php

namespace App\controller;

use App\model\DTO\CategoryDTO;
use App\services\CategoryService;
use App\services\IService;
use App\services\PostService;

class CategoryController extends BaseController implements IResourceController
{
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
        $category_id = $_GET['id'] ?? null;

        switch ($operation) {
            case null:
            case 'show':
                $this->show();
                break;
            case 'add':
                $this->create();
                break;
            case 'edit':
                $this->edit($category_id);
                break;
            case 'get':
                $this->get($category_id);
                break;
            case 'remove':
                $this->remove($category_id);
                break;
            case 'save':
                $this->save();
                break;
            case 'update':
                $this->update($category_id);
                break;
            default:
                $this->showError("Wrong operation", "Page for operation '$operation' not found");
                break;
        }
    }

    public function show()
    {
        $title = 'Categories';

        $categories = $this->categoryService->getAll();

        include('views/categories/categories.php');
    }

    public function create()
    {
        $title = 'Add a new category';
        $mode = 'add';

        $allPosts = $this->postService->getAll();

        include('views/categories/category.php');
    }

    public function edit(int $id)
    {
        $title = 'Edit a category';
        $mode = 'edit';

        $allPosts = $this->postService->getAll();
        $category = $this->categoryService->getInstance($id);

        include('views/categories/category.php');
    }

    public function remove(int $id)
    {
        $this->categoryService->removeInstance($id);
        $this->redirect('?resource=categories');
    }

    public function save()
    {
        $posts = $_POST['posts'] ?? null;
        $this->categoryService->saveInstance(new CategoryDTO(
                null,
                $_POST['name'],
                $posts)
        );
        $this->redirect("/?resource=categories");
    }

    public function update(int $id)
    {

        $this->categoryService->updateInstance(new CategoryDTO(
            $id,
            $_POST['name'],
            $_POST['posts'])
        );
        $this->redirect("/?resource=categories&id={$id}&action=get");
    }

    public function get(int $id)
    {
        $category = $this->categoryService->getInstance($id);

        $mode = 'get';
        $title = $category->getName();

        include('views/categories/category.php');
    }
}
