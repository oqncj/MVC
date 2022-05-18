<?php

namespace src\Routing;

class ReqeustContent {  //

    public $method;

    public $path;

    public $handler;

    public $middleware;

    public function __construct( $method, $path, $handler, $middleware = [] ) {

        $this->method = $method;
        $this->path = $path;
        $this->handler = $handler;
        $this->middleware = $middleware;

    }

    public function match( $url ) {
        $urlParts = explode( '/', $url ); // for Home
        $urlPattern = explode( '/', $this->path ); // /pages  <- Path
        if ( $url === $this->path ) {
            $urlParam = [];
            foreach ( $urlPattern as $key => $part ) {
                if ( preg_match( '/(\/.*)$/', $part ) ) { // hmm.....??
                    $urlParam[$key] = $part;
                } else {
                    if ( $urlParts[$key] !== $part ) {
                        return null;
                    }
                }
            }
            return count( $urlParam ) < 1
                ? []
                : array_map( fn( $test ) => $urlParts[$test], array_keys( $urlParam ) ); //
        }
    }

    public function runMiddlewares() {

        foreach ( $this->middleware as $middlewares ) {
            if ( !$middlewares::process() ) {
                return false;
            }
        }
        return true;

    }
}
