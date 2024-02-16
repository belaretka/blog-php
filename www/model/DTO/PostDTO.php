<?php

namespace App\model\DTO;

class PostDTO
{
    private $id;
    private $title;
    private $content;
    private $created_at;
    private $categories;

    public function __construct($id = null, $created_at = null, $title = null, $content = null, $categories = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $created_at;
        $this->categories = $categories;
    }

    public function setDTO($obj): void
    {
        $this->id = $obj->id;
        $this->title = $obj->title;
        $this->content = $obj->content;
        $this->created_at = $obj->created_at;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setCreatedAt(mixed $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }
}
