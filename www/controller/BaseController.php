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

    public function getUri()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'],);
        return $uri;
    }

    public function handleRequest(): void
    {
        $resource = $_REQUEST['resource'] ?? 'start';

        switch ($resource) {
            case 'start':
                $title = 'Blog';
                include('views/start-menu.php');
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
}