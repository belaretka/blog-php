<?php

namespace App\services;

interface IService
{
    public function getEntity(int $entity_id);
    public function getAllEntities();
//    public function createEntity(mixed $entity);
    public function removeEntity(int $entity_id);
}