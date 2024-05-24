<?php 

namespace App\Controllers;
use App\Database\Database;
use App\Controllers\Controller;

class PeopleController extends Controller
{
    public function index()
    {
        $peoples = $this->db->get('peoples');

        return [
            'data' => $peoples,
        ];
    }

    public function show()
    {
        if (empty($_GET)) {
            return [
                'message' => 'Отправьте параметры для поиска в get'
            ];
        }

        $peoples = $this->db->get('peoples', $_GET);

        return [
            'peoples' => $peoples
        ];
    }
}