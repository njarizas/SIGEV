<?php

/**
 * Connection properties
 *
 * @author: http://phpdao.com
 * @date: 27.11.2007
 */
class ConnectionProperty {

    private static $host = 'localhost';
    private static $user = 'user_sigev';
    private static $password = 'user_sigev';
    private static $database = 'db_sigev';

    public static function getHost() {
        return ConnectionProperty::$host;
    }

    public static function getUser() {
        return ConnectionProperty::$user;
    }

    public static function getPassword() {
        return ConnectionProperty::$password;
    }

    public static function getDatabase() {
        return ConnectionProperty::$database;
    }

}

?>