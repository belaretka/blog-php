<?php

namespace App\controller;

interface IController
{
    public function showError(string $title, string $message): void;
    public function getUri();
    public function handleRequest(): void;
}