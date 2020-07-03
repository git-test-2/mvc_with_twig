<?php

namespace App\Models;

class Base
{
    protected static $pdo;

    protected function getConnect()
    {
        if (self::$pdo === null) {
            self::$pdo = new \PDO(
                DSN_DB, USERNAME_DB, PASSWORD_DB
            );
        }
        return self::$pdo;
    }

}