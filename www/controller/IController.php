<?php

namespace App\controller;

interface IController
{
    public function showError(string $title, string $message): void;
    public function handleRequest(): void;
}