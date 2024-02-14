<?php

namespace App\repos;

interface IRepository
{
    public function selectAll();
    public function selectById(int $selected);
    public function deleteById(int $selected);
}