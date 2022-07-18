<?php
use Illuminate\Database\Capsule\Manager as Capsule;
/* use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container; */


$DB = new Capsule();
$DB->addConnection([
    'driver'    => 'mysql',
    'host'      => DATABASE_SERVER,
    'database'  => DATABASE_NAME,
    'username'  => DATABASE_USERNAME,
    'password'  => DATABASE_PASSWORD, 
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci', 
    'prefix'    => '',
]);

// Set the event dispatcher used by Eloquent models... (optional)
//$DB->setEventDispatcher(new Dispatcher(new Container));

//Make this Capsule instance available globally.
$DB->setAsGlobal();

// Setup the Eloquent ORM.

$DB->bootEloquent();