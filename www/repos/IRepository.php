<?php

namespace App\repos;

interface IRepository
{
    public function selectAll();
    public function selectById(int $toSelect);
    public function deleteById(int $toDelete);
    public function count();
    public function insert(mixed $toInsert);
    public function update(mixed $toUpdate);
}