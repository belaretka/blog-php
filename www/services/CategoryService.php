<?php

namespace App\services;

use App\repos\CategoryRepository;
use App\repos\IRepository;

class CategoryService implements IService
{
    public IRepository $categories;

    public function __construct()
    {
        $this->categories = new CategoryRepository();
    }

    public function getAllEntities(): bool|array
    {
        return $this->categories->selectAll();
    }

    public function getEntity(int $entity_id)
    {
        return $this->categories->selectById($entity_id);
    }

    public function removeEntity(int $entity_id)
    {
        $this->categories->deleteById($entity_id);
    }


}
