<?php

namespace App\config;

use App\services\parser\JsonParser;

class Config
{
    const filename = "data.json";

    public static $DB_DRIVER;
    public static $USER;
    public static $PASSWORD;
    public static $HOST;
    public static $DB_NAME;
    public static $CHARSET;
    public static $PIVOT;
    public static $CATEGORIES;
    public static $POSTS;

    public static function load(): void
    {
        foreach (JsonParser::readJson(self::filename) as $key => $prop) {
            self::$$key=$prop;
        }
    }
}