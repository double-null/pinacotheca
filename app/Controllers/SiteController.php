<?php

namespace App\Controllers;

use Flight;

class SiteController
{
    public static function notFound()
    {
        Flight::view()->display('site/not_found.tpl');
        Flight::stop(404);
    }
}