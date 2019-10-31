<?php

namespace App\Controllers;

use Flight;
use App\Models\PictureModel;
use App\Helpers\Cleaner;

class PictureController extends Controller
{
    public function view()
    {
        Flight::view()->display('picture/view.tpl');
    }

    public function listing($page = 1)
    {
        $model = new PictureModel();
        $pictures = $model->getPictures($page);
        Flight::view()->assign('pagination', $model->pagination);
        Flight::view()->assign('pictures', $pictures);
        Flight::view()->display('picture/listing.tpl');
    }

    public function load()
    {
        if (empty($_SESSION['user'])) {
            Flight::notFound();
            return 1;
        }
        if (!empty($_POST['load'])) {
            $data = Cleaner::filter($_POST['Picture']);
            $model = new PictureModel();
            $valid_data = $model->validatePicture($data);
            if ($valid_data) {
                if ($model->save($data)) {
                    Flight::view()->assign('success', 1);
                } else {
                    Flight::view()->assign('save_error', 1);
                }
            } else {
                Flight::view()->assign('errors', $model->errors());
                Flight::view()->assign('past_data', $data);
            }
        }
        Flight::view()->display('picture/load.tpl');
    }

    public function delete($id)
    {
        $model = new PictureModel();
        $model->delete($id);
        echo json_encode(['error' => $model->errors()]);
    }
}
