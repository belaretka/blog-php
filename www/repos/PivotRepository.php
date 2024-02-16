<?php

namespace App\repos;

class PivotRepository
{
    public $connection;

    const PIVOT = 'category_post';
    const CATEGORIES = 'categories';
    const POSTS = 'posts';

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function selectPostsByCategoryId(int $category_id)
    {
        $sql = 'SELECT DISTINCT ' . self::POSTS . '.id, ' . self::POSTS . '.created_at, ' . self::POSTS
            . '.title, ' . self::POSTS . '.content FROM ' . self::POSTS
            . ' JOIN ' . self::PIVOT
            . ' ON ' . self::POSTS . '.id = ' . self::PIVOT . '.post_id WHERE ' . self::PIVOT . '.category_id = :id;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $category_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\model\Post');
    }

    public function selectCategoriesByPostId(int $post_id)
    {
        $sql = 'SELECT DISTINCT ' . self::CATEGORIES . '.id, ' . self::CATEGORIES . '.name FROM '
            . self::CATEGORIES
            . ' JOIN ' . self::PIVOT
            . ' ON ' . self::CATEGORIES . '.id = ' . self::PIVOT . '.category_id WHERE ' . self::PIVOT . '.post_id = :id;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $post_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\model\Category');
    }

    public function insert($post_id, $category_id)
    {
        $sql = 'INSERT INTO ' . self::PIVOT . ' (post_id, category_id) VALUES (:post_id, :category_id);';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':post_id', $post_id, \PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $category_id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteByCategoryId(int $toDelete)
    {
        $sql = 'DELETE FROM ' . self::PIVOT . ' WHERE category_id =:entity_id;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $toDelete);
        $stmt->execute();
    }

    public function deleteByPostId(int $toDelete)
    {
        $sql = 'DELETE FROM ' . self::PIVOT . ' WHERE post_id =:entity_id;';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':entity_id', $toDelete);
        $stmt->execute();
    }
}
