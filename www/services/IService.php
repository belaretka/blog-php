<?php

namespace App\services;

interface IService
{
    public function getInstance(int $instance_id);
    public function getAll();
    public function saveInstance(mixed $instance);
    public function removeInstance(int $instance_id);
    public function updateInstance(mixed $instance);
}