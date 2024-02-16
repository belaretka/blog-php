<?php

namespace App\config;

class Config
{
    const filename = "data.json";

    public static $DB_DRIVER;
    public static $USER;
    public static $PASSWORD;
    public static $HOST;
    public static $DB_NAME;
    public static $CHARSET;

    public static function load(): void
    {
        foreach (JsonParser::readJson(self::filename) as $key => $prop) {
            self::$$key=$prop;
        }
    }
}