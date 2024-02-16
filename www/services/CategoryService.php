<?php

namespace App\services;

use App\model\DTO\CategoryDTO;
use App\repos\CategoryRepository;
use App\repos\IRepository;
use App\repos\PivotRepository;

class CategoryService implements IService
{
    public IRepository $category_repo;
    public PivotRepository $pivot_repo;

    public function __construct()
    {
        $this->category_repo = new CategoryRepository();
        $this->pivot_repo = new PivotRepository();
    }

    public function getAll(): bool|array
    {
        return $this->category_repo->selectAll();
    }

    public function getInstance(int $instance_id)
    {
        $category = new CategoryDTO();

        $category->setDTO($this->category_repo->selectById($instance_id));
        $category->setPosts($this->pivot_repo->selectPostsByCategoryId($instance_id));

        return $category;
    }

    public function removeInstance(int $instance_id)
    {
        $this->pivot_repo->deleteByCategoryId($instance_id);
        $this->category_repo->deleteById($instance_id);
    }

    public function saveInstance(mixed $category)
    {
        $this->category_repo->insert($category);
        if($category->getPosts() !== null) {
            foreach ($category->getPosts() as $post) {
                $this->pivot_repo->insert($category->getId(), $post);
            }
        }
    }

    public function updateInstance(mixed $category)
    {
        $this->pivot_repo->deleteByCategoryId($category->getId());
        $this->category_repo->update($category);
        foreach ($category->getPosts() as $post) {
            $this->pivot_repo->insert($post, $category->getId());
        }
    }
}
