<?php

namespace WebApi\Db;

use \mysqli;

require_once('../Db/config.php');

class Connection
{
    /**@var mysqli $instance*/
    private static $instance = null;

    /**
     * @return mysqli
     * @throws \Exception
     */
    public static function getInstance()
    {
        if (static::$instance) {
            return static::$instance;
        }

        static::$instance = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);

        if (static::$instance->connect_error) {
            throw new \Exception(static::$instance->connect_error);
        }

        return static::$instance;
    }
}