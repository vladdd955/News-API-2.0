<?php

namespace App;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class Database

{
    private static ?Connection $connection = null;

    public static function getConnection(): ?Connection
    {
        if(self::$connection == null) {
            $connectionParams = [
                'dbname' => 'news api',
                'user' => 'root',
                'password' => 'nishiki555',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            ];
            self::$connection= DriverManager::getConnection($connectionParams);
        }
        return self::$connection;
    }
}