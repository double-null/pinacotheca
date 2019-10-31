<?php
session_start();
require_once '/vendor/autoload.php';

use App\Controllers;

Flight::register('view', 'Smarty', [], function($smarty){
    $smarty->template_dir = './app/Views/Templates/Pinacotheca/';
    $smarty->compile_dir = './app/Views/Compiled/';
    //$smarty->config_dir = './config/';
    //$smarty->cache_dir = './cache/';
});

Flight::register('db', 'Medoo\Medoo', [database()]);

Flight::route('/', function (){
    $c = new App\Controllers\PictureController;
    $c->listing();
});

Flight::route('/registration/', function (){
    $c = new App\Controllers\UserController;
    $c->create();
});

Flight::route('/login/', function (){
    $c = new App\Controllers\UserController;
    $c->login();
});

Flight::route('/logout/', function (){
    $c = new App\Controllers\UserController;
    $c->logout();
});

Flight::route('/pictures/@page/', function($page){
    $c = new App\Controllers\PictureController;
    $c->listing($page);
});

Flight::route('/load_picture/', function (){
    $c = new App\Controllers\PictureController;
    $c->load();
});

Flight::route('/drop_picture/@id/', function ($id){
    $c = new App\Controllers\PictureController;
    $c->delete($id);
});

Flight::map('notFound', ['App\Controllers\SiteController', 'notFound']);

Flight::start();