<?php

namespace src\Routing;

abstract class Middleware{
    abstract public static function process();
}