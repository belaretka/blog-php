<?php

namespace App\controller;

interface IResourceController
{
    function create();
    function edit(int $id);
    function get(int $id);
    function remove(int $id);
    function save();
    function update(int $id);
}