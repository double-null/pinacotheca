<?php

namespace App\Models;

use Flight;

class UserModel extends Model
{
    protected $table = 'users';

    public function validate($data)
    {
        if ($data['nickname'] == '') {
            $this->errors['nickname'] = 'Имя не заполнено';
        } elseif (strlen($data['nickname']) < 2 ) {
            $this->errors['nickname'] = 'Имя должно содержать более 2х символов';
        } elseif (strlen($data['nickname']) > 16 ) {
            $this->errors['nickname'] = 'Имя должно содержать не более 16 символов';
        } elseif ($this->existUser($data['nickname'])) {
            $this->errors['nickname'] = 'Пользователь с таким ником уже существует';
        }
        if ($data['email'] == '') {
            $this->errors['email'] = 'Эл.Почта не заполнена';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Эл.Почта введена не корректно';
        }
        if ($data['password'] == '') {
            $this->errors['password'] = 'Пароль не заполнен';
        } elseif (strlen($data['password']) < 8 ) {
            $this->errors['password'] = 'Пароль должен содержать более 8 символов';
        } elseif (strlen($data['password']) > 50 ) {
            $this->errors['password'] = 'Пароль должен содержать не более 50 символов';
        }
        if ($data['repass'] != $data['password']) {
            $this->errors['repass'] = 'Пароли не совпадают';
        }
        return ($this->errors) ? false : true;
    }

    public function existUser($nickname)
    {
        return Flight::db()->has($this->table, ['nickname' => $nickname]);
    }

    public function getUserByPassword($data)
    {
        $data['password'] = md5(md5($data['password']));
        return Flight::db()->get($this->table, ['id', 'nickname'], ['AND' => $data]);
    }

    public function save($data)
    {
        $data['password'] = md5(md5($data['password']));
        $data['period'] = time();
        unset($data['repass']);
        Flight::db()->insert($this->table, $data);
        return Flight::db()->id();
    }
}
