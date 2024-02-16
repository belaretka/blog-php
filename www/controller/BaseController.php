<?php

namespace App\controller;

class BaseController implements IController
{
    public function showError(string $title = 'Error', string $message = 'Not Found'): void
    {
        include('views/error.php');
    }

    protected function redirect($location): void
    {
        header('Location: ' . $location);
    }

    public function handleRequest(): void
    {
        $resource = $_REQUEST['resource'] ?? null;

        switch ($resource) {
            case null:
                $this->getStartPage();
                break;
            case 'posts':
                $controller = new PostController();
                $controller->handleRequest();
                break;
            case 'categories':
                $controller = new CategoryController();
                $controller->handleRequest();
                break;
            default:
                $this->showError("Wrong resource", "Page for resource '$resource' not found");
                break;
        }
    }

    protected function getStartPage()
    {
        $title = 'Blog';
        include('views/start-menu.php');
    }
}