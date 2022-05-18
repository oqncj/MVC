<?php


require_once './vendor/autoload.php';

use src\Support\ServiceProvider;
use src\Application;

class SessionServiceProvider extends ServiceProvider{
    public static function register(){


    }

    public static function boot() {

    }

}

$app = new Application([
    ServiceProvider::class
]);

$app->boot();
