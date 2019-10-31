<?php

namespace App\Models;

use Flight;
use WideImage\WideImage;

class PictureModel extends Model
{
    protected $table = 'pictures';

    protected $itemsOnPage = 30;

    public $pagination;

    public function validatePicture($data)
    {
        $types = ['jpg', 'jpeg', 'gif', 'png'];
        $picture = $_FILES['picture'];
        $pict_type = explode('/', $picture['type'])[1];
        if ($data['name'] == '') {
            $this->errors['name'] = 'Название не заполнено';
        } elseif (strlen($data['name']) > 40) {
            $this->errors['name'] = 'Длинна названия не более 40 символов';
        } elseif (strlen($data['name']) < 4) {
            $this->errors['name'] = 'Длинна названия не менее 4 символов';
        }
        if ($data['description'] == '') {
            $this->errors['description'] = 'Описание не заполнено';
        } elseif (strlen($data['description']) > 250) {
            $this->errors['description'] = 'Длинна описания не более 250 символов';
        } elseif (strlen($data['description']) < 4) {
            $this->errors['description'] = 'Длинна описания не менее 4 символов';
        }
        if ($picture['size'] === 0) {
            $this->errors['picture'] = 'Изображение не выбрано';
        } elseif (!in_array($pict_type, $types)) {
            $this->errors['picture'] = 'Неверный формат изображения';
        } elseif ($picture['size'] > 1024000) {
            var_dump($picture['size']);
            $this->errors['picture'] = 'Размер изображения не может превышать 1мб';
        }
        return ($this->errors) ? false : true;
    }

    public function save($data)
    {
        $period = time();
        $user = $_SESSION['user']['id'];
        $picture = $_FILES['picture'];
        $pictType = explode('/', $picture['type'])[1];
        $physicalName = $period .'_'.$user.'.'.$pictType;
        $data['user'] = $_SESSION['user']['id'];
        $data['period'] = $period;
        $data['physical_name'] = $physicalName;
        Flight::db()->insert($this->table, $data);
        if (Flight::db()->id()) {
            $uploadfile = 'images/uploaded/'.$physicalName;
            if (move_uploaded_file($picture['tmp_name'], $uploadfile)) {
                $minimalFile = 'images/minimal/'.$physicalName;
                $image = WideImage::loadFromFile($uploadfile);
                $image->resize(250)->saveToFile($minimalFile);
                return true;
            } else {
                Flight::db()->delete($this->table, ['id' => Flight::db()->id()]);
                return false;
            }
        } else { return false; }
    }

    public function getPictures($page = 1)
    {
        $totalPictures = Flight::db()->count($this->table);
        $totalPages = ceil($totalPictures/$this->itemsOnPage);
        $start = $page * $this->itemsOnPage - $this->itemsOnPage;
        $this->pagination = ['total' => $totalPages, 'current' => $page];
        return Flight::db()->select($this->table, '*', ['LIMIT' => [$start, $this->itemsOnPage]]);
    }

    public function delete($id)
    {
        $file = Flight::db()->get($this->table, ['physical_name', 'user'], ['id' => $id]);
        if($_SESSION['user']['id'] == $file['user']) {
            $originalPicture = 'images/uploaded/'.$file['physical_name'];
            $minimalPicture = 'images/minimal/'.$file['physical_name'];
            if (file_exists($originalPicture)) { unlink($originalPicture); }
            if (file_exists($minimalPicture)) { unlink($minimalPicture); }
            parent::delete($id);
        } else {
            $this->errors['delete'] = 'Ошибка доступа!';
        }
    }
}
