<?php

namespace App\repos;

class CategoryRepository implements IRepository
{
    public $connection;

    const TABLE = 'categories';
    const PIVOT = 'category_post';

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function selectAll()
    {
        $sql = 'SELECT * FROM ' . self::TABLE;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\model\DTO\CategoryDTO');
    }

    public function selectById(int $selected)
    {
        $sql = 'SELECT id, name FROM ' . self::TABLE . ' WHERE id = :entity_id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $selected);
        $stmt->execute();
        $res = $stmt->fetch(\PDO::FETCH_CLASS | \PDO::FETCH_CLASSTYPE, 'App\model\DTO\CategoryDTO');
        return $res;
    }

    public function deleteById(int $selected)
    {
        $sql = 'DELETE FROM ' . self::PIVOT . ' WHERE category_id =:entity_id;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $selected);
        $stmt->execute();
        $sql = 'DELETE FROM ' . self::TABLE  . ' WHERE id = :entity_id;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $selected);
        $stmt->execute();
    }
}
