<?php

namespace App\model\DTO;

class CategoryDTO implements \JsonSerializable
{
    private $id;
    private $name;

    public function __construct($id = null, $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function jsonSerialize() : mixed
    {
        return [
            "id" => $this->id,
            "name" => $this->name
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}
