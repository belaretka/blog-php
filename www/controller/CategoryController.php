<?php

namespace App\controller;

use App\services\IService;
use App\services\CategoryService;

class CategoryController extends BaseController
{
    public IService $service;

    public function __construct()
    {
        $this->service = new CategoryService();
    }

    public function handleRequest(): void
    {
        $operation = $_GET['action'] ?? null;
        $id = $_GET['id'] ?? null;

        switch ($operation){
            case null:
            case 'show':
                $this->show(); break;
            case 'edit':
                $this->edit($id); break;
            case 'add':
                $this->add(); break;
            case 'remove':
                $this->remove($id); break;
            case 'get':
                $this->get($id);break;
            default:
                $this->showError("Wrong operation", "Page for operation '$operation' not found"); break;
        }
    }

    public function show()
    {
        $title = 'Categories';
        $categories = $this->service->getAllEntities();

        include('views/categories/categories.php');
    }

    public function edit()
    {

    }

    public function add()
    {

    }

    public function remove(int $id)
    {
        $this->service->removeEntity($id);
        $this->redirect('?resource=categories');
    }

    public function getResource()
    {
    }
}