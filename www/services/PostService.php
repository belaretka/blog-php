<?php

namespace App\services;

use App\model\DTO\PostDTO;
use App\repos\PivotRepository;
use App\repos\PostRepository;
use App\repos\IRepository;

class PostService implements IService
{
    public IRepository $post_repo;
    public PivotRepository $pivot_repo;

    public function __construct()
    {
        $this->post_repo = new PostRepository();
        $this->pivot_repo = new PivotRepository();
    }

    public function getAll(): bool|array
    {
        return $this->post_repo->selectAll();
    }

    public function getPostsPerPage(int $page, int $postsPerPage)
    {
        $limit = $postsPerPage;
        $offset = $postsPerPage * ($page - 1);

        return $this->post_repo->selectAll($limit, $offset);
    }

    public function countPosts()
    {
        return $this->post_repo->count();
    }

    public function getInstance(int $instance_id): PostDTO
    {
        $post = new PostDTO();
        $post->setDTO($this->post_repo->selectById($instance_id));
        $post->setCategories($this->pivot_repo->selectCategoriesByPostId($instance_id));
        return $post;
    }

    public function removeInstance(int $id)
    {
        $this->pivot_repo->deleteByPostId($id);
        $this->post_repo->deleteById($id);
    }

    public function saveInstance(mixed $post)
    {
        $this->post_repo->insert($post);
        if($post->getCategories() !== null) {
            foreach ($post->getCategories() as $category) {
                $this->pivot_repo->insert($post->getId(), $category);
            }
        }
    }

    public function updateInstance(mixed $post)
    {
        $this->pivot_repo->deleteByPostId($post->getId());
        $this->post_repo->update($post);
        foreach ($post->getCategories() as $category) {
            $this->pivot_repo->insert($post->getId(), $category);
        }
    }
}
