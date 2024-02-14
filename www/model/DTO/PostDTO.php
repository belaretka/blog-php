<?php

namespace App\model\DTO;

class PostDTO implements \JsonSerializable
{
    private $id;
    private $title;
    private $content;
    private $created_at;

    public function __construct($id = null, $created_at = null, $title = null, $content = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $created_at;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "id" => $this->id,
            "created_at" => $this->created_at,
            "title" => $this->title,
            "content" => $this->content
        ];
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


}