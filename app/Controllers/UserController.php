<?php

namespace App\Controllers;

use Flight;
use App\Models\UserModel;
use App\Helpers\Cleaner;

class UserController extends Controller
{
    public function create()
    {
        if (!empty($_POST['User'])) {
            $data = Cleaner::filter($_POST['User']);
            $model = new UserModel();
            if ($model->validate($data)) {
                $result = $model->save($data);
                if ($result) {
                    Flight::view()->assign('success', 1);
                } else {
                    Flight::view()->assign('db_error', 1);
                }
            } else {
                Flight::view()->assign('errors', $model->errors());
            }
        }
        Flight::view()->display('user/create.tpl');
    }

    public function login()
    {
        if(!empty($_POST['User'])) {
            $data = Cleaner::filter($_POST['User']);
            $model = new UserModel();
            $user = $model->getUserByPassword($data);
            if ($user) {
                $_SESSION['user'] = $user;
                Flight::redirect('/');
            } else {
                Flight::view()->assign('error', 1);
            }
        }
        Flight::view()->display('user/login.tpl');
    }

    public function logout()
    {
        session_destroy();
        Flight::redirect('/');
    }
}
