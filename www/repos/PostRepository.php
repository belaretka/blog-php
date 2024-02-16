<?php

namespace App\repos;

use App\model\DTO\PostDTO;

class PostRepository implements IRepository
{
    public $connection;

    const TABLE = 'posts';
    const PIVOT = 'category_post';

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function count()
    {
        $sql = 'SELECT COUNT(*) AS amount FROM ' . self::TABLE;

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC)["amount"];
    }

    private function selectAvailableId()
    {
        return $this->count() + 1;
    }

    public function insert(mixed $post): void
    {
        $post->setId($this->selectAvailableId());

        $sql = 'INSERT INTO ' . self::TABLE . ' (id, created_at, title, content) VALUES (:id, :created_at, :title, :content);';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $post->getId());
        $stmt->bindValue(':created_at', $post->getCreatedAt());
        $stmt->bindValue(':title', $post->getTitle());
        $stmt->bindValue(':content', $post->getContent());

        $stmt->execute();
    }

    public function selectAll(int $limit = null, int $offset = null)
    {
        $sql = isset($limit) && isset($offset) ?
            'SELECT id, created_at, title, content FROM ' . self::TABLE . ' LIMIT :limit OFFSET :offset'
            : 'SELECT id, created_at, title, content FROM ' . self::TABLE;

        $stmt = $this->connection->prepare($sql);
        if (isset($limit) && isset($offset)) {
            $stmt->bindParam(':limit', $limit,\PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        }
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\model\DTO\PostDTO');
    }

    public function selectById(int $toSelect)
    {
        $sql = 'SELECT id, created_at, title, content FROM ' . self::TABLE . ' WHERE id = :entity_id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $toSelect);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function deleteById(int $toDelete)
    {
        $sql = 'DELETE FROM ' . self::TABLE . ' WHERE id = :entity_id;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $toDelete);
        $stmt->execute();
    }

    public function update(mixed $post)
    {
        $sql = 'UPDATE ' . self::TABLE . ' SET title = :title, created_at = :created_at, content = :content WHERE id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':title', $post->getTitle());
        $stmt->bindValue(':created_at', $post->getCreatedAt());
        $stmt->bindValue(':content', $post->getContent());
        $stmt->bindValue(':id', $post->getId());

        $stmt->execute();
    }
}