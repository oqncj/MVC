<?php


require_once './vendor/autoload.php';

use src\Support\ServiceProvider;
use src\Application;
use src\DB\Database;

Database::setup('mysql:host=localhost:3306;dbname=ImageGallery','root','root');


class SessionServiceProvider extends ServiceProvider{
    public static function register(){

    }

    public static function boot() {
        parent::boot();
    }

}

$app = new Application([
    ServiceProvider::class
]);

$app->boot();
