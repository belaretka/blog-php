<?php

namespace App\model\DTO;

class CategoryDTO
{
    private $id;
    private $name;
    private $posts;

    public function __construct($id = null, $name = null, $posts = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->posts = $posts;
    }

    public function setDTO($obj): void
    {
        $this->id = $obj->id;
        $this->name = $obj->name;
    }

    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function setPosts(array $posts): void
    {
        $this->posts = $posts;
    }
}

