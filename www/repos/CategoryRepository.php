<?php

namespace App\repos;

use App\config\Config;
use App\model\DTO\CategoryDTO;

class CategoryRepository implements IRepository
{
    public $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function count() {
        $sql = 'SELECT COUNT(*) AS count FROM ' . Config::$CATEGORIES;

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC)["count"];
    }

    protected function selectAvailableId() {
        return $this->count() + 1;
    }

    public function selectAll(): bool|array
    {
        $sql = 'SELECT id, name FROM ' . Config::$CATEGORIES;

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\model\DTO\CategoryDTO');
    }

    public function selectById(int $toSelect)
    {
        $sql = 'SELECT id, name FROM ' . Config::$CATEGORIES . ' WHERE id = :entity_id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $toSelect);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function deleteById(int $toDelete)
    {
        $sql = 'DELETE FROM ' . Config::$CATEGORIES  . ' WHERE id = :entity_id;';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $toDelete);

        $stmt->execute();
    }

    public function insert(mixed $toInsert): void {
        $toInsert->setId($this->selectAvailableId());

        $sql = 'INSERT INTO ' . Config::$CATEGORIES . ' (id, name) VALUES (:id, :name);';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $toInsert->getId());
        $stmt->bindValue(':name', $toInsert->getName());

        $stmt->execute();
    }

    public function update(mixed $toUpdate) {
        $sql = 'UPDATE ' . Config::$CATEGORIES . ' SET name = :name WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':name', $toUpdate->getName());
        $stmt->bindValue(':id', $toUpdate->getId());
        $stmt->execute();
    }
}
