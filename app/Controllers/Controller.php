<?php

namespace App\Controllers;

use Flight;

class Controller
{
    public function __construct()
    {
        if ($_SESSION['user'])
        {
            Flight::view()->assign('user', $_SESSION['user']);
        }
    }
}
