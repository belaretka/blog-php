<?php

namespace App\services;

use App\repos\PostRepository;
use App\repos\IRepository;

class PostService implements IService
{
    public IRepository $posts;

    public function __construct()
    {
        $this->posts = new PostRepository();
    }

    public function getAllEntities(): bool|array
    {
        return $this->posts->selectAll();
    }

    public function getEntity(int $entity_id)
    {
       return $this->posts->selectById($entity_id);
    }

    public function removeEntity(int $entity_id)
    {
        $this->posts->deleteById($entity_id);
    }


}