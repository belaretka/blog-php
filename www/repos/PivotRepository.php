<?php

namespace App\repos;

use App\config\Config;

class PivotRepository
{
    public $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function selectPostsByCategoryId(int $category_id)
    {
        $sql = 'SELECT DISTINCT ' . Config::$POSTS . '.id, ' . Config::$POSTS . '.created_at, ' . Config::$POSTS
            . '.title, ' . Config::$POSTS . '.content FROM ' . Config::$POSTS
            . ' JOIN ' . Config::$PIVOT
            . ' ON ' . Config::$POSTS . '.id = ' . Config::$PIVOT . '.post_id WHERE ' . Config::$PIVOT . '.category_id = :id;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $category_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\model\Post');
    }

    public function selectCategoriesByPostId(int $post_id)
    {
        $sql = 'SELECT DISTINCT ' . Config::$CATEGORIES . '.id, ' . Config::$CATEGORIES . '.name FROM '
            . Config::$CATEGORIES
            . ' JOIN ' . Config::$PIVOT
            . ' ON ' . Config::$CATEGORIES . '.id = ' . Config::$PIVOT . '.category_id WHERE ' . Config::$PIVOT . '.post_id = :id;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $post_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\model\Category');
    }

    public function insert($post_id, $category_id)
    {
        $sql = 'INSERT INTO ' . Config::$PIVOT . ' (post_id, category_id) VALUES (:post_id, :category_id);';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':post_id', $post_id, \PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $category_id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteByCategoryId(int $toDelete)
    {
        $sql = 'DELETE FROM ' . Config::$PIVOT . ' WHERE category_id =:entity_id;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $toDelete);
        $stmt->execute();
    }

    public function deleteByPostId(int $toDelete)
    {
        $sql = 'DELETE FROM ' . Config::$PIVOT . ' WHERE post_id =:entity_id;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $toDelete);
        $stmt->execute();
    }
}
