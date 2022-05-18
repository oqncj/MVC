<?php

namespace src\Routing;

use src\Http\Request;

class Route {


    private static array $contexts = [];

    public static function add( $method, $path, $handler, $middleware = [] ) {

        self::$contexts[] = new ReqeustContent( $method, $path, $handler, $middleware );
    }


    public static function run() {
        foreach ( self::$contexts as $context ) {
            if ( $context->method == strtolower( Request::Method() ) && is_array( $urlParams = $context->match( Request::getPath() ) ) ) {
                if ( $context->runMiddlewares() ) {

                    return call_user_func( $context->handler, $urlParams );

                }
                return false;
            }
        }

    }

}

