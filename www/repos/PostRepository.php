<?php

namespace App\repos;

use App\model\Post;

class PostRepository implements IRepository
{
    public $connection;

    const TABLE = 'posts';
    const PIVOT = 'category_post';

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function insert(Post $post): void {

    }

    public function selectAll() {
        $sql = 'SELECT id, created_at, title, content FROM ' . self::TABLE;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\model\DTO\PostDTO');
    }


    public function selectById(int $selected)
    {
        $sql = 'SELECT id, created_at, title, content FROM ' . self::TABLE . ' WHERE id = :entity_id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $selected);
        $stmt->execute();
        $res = $stmt->fetch(\PDO::FETCH_CLASS | \PDO::FETCH_CLASSTYPE, 'App\model\DTO\PostDTO');
        return $res;

    }

    public function deleteById(int $selected)
    {
        $sql = 'DELETE FROM ' . self::PIVOT . ' WHERE post_id =:entity_id;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $selected);
        $stmt->execute();
        $sql = 'DELETE FROM ' . self::TABLE  . ' WHERE id = :entity_id;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $selected);
        $stmt->execute();
    }
}