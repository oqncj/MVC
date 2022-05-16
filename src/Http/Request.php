<?php

namespace src\Http;

class Request {

    /* protected array $routes = [];*/

    public static function Method() {

        return filter_input( INPUT_POST, '_method' ) ?: $_SERVER['REQUEST_METHOD'];  // Get oder Post

    }

    public static function getPath() {

        return $_SERVER['PATH_INFO'] ?? '/';

    }

}