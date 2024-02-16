<?php

namespace App\services\parser;

class JsonParser
{
    public static function readJson(string $filename)
    {
        $content = file_get_contents($filename);
        return json_decode($content);
    }
}