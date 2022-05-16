<?php

namespace src\DB;

use PDO;

class Database {

    private static $setup;

    private static $execute;

    public static function setup( $dsn, $username, $password ) {  // DB setup per Function

        self::$setup = new PDO( $dsn, $username, $password );

    }

    public static function exec( $query, $params = [] ) { // DB durchführen
        if ( self::$execute = self::$setup->prepare( $query ) ) {
            return self::$execute->execute( $params );
        }
    }

    public static function getAll( $query, $params = [], $classname = 'stdClass' ) {

        if ( self::exec( $query, $params ) ) {
            return self::$execute->fetchAll( PDO::FETCH_CLASS, $classname );
        }
    }


}