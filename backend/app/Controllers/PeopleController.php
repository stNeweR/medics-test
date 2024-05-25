<?php 

namespace App\Controllers;

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

    public function store()
    {
        $data = $this->request->validate([
            'first_name' => ['required', 'min:3', 'max:50'],
            'second_name' => ['required', 'min:3', 'max:50'],
            'last_name' => ['required', 'min:3', 'max:50'],
        ]);

        if (isset($data['errors'])) {
            return [
                'message' => 'Валидация не пройдена',
                'errors' => $data['errors']
            ];
        }

        $result = $this->db->insert('peoples', $data);

        if(isset($result['error'])) {
            return ['error' => $result['error']];
        } else {
            return $result;
        }
    }
}