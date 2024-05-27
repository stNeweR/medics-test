<?php

namespace App\Controllers;

use App\Controllers\Controller;

class PeoplePhoneController extends Controller
{
    public function store()
    {
        $data = $this->request->validate([
            'phone_number' => ['required', 'personPhone', 'unique:people_phones'],
        ]);

        if (isset($data['errors'])) {
            return [
                'message' => 'Валидация не пройдена',
                'errors' => $data['errors']
            ];
        }

        if (empty($_GET['id'])) {
            return [ 'message' => 'Отправьте id для поиска через get' ];
        }

        $person = $this->db->get('peoples', $_GET);
        if (empty($person)) {
            return [ 'message' => 'Пользователь с таким id не найден' ];
        }

        $data['people_id'] = $person[0]['id'];

        $result = $this->db->insert('people_phones', $data);

        if(isset($result['error'])) {
            return ['error' => $result['error']];
        } else {
            return $result;
        }
    }

    public function delete()
    {
        if (empty($_GET['id'])) {
            return [ 'message' => 'Отправьте id для поиска через get' ];
        }

        $result = $this->db->delete('people_phones', $_GET['id']);

        if(isset($result['error'])) {
            return ['error' => $result['error']];
        } else {
            return $result;
        }
    }

    public function update()
    {
        if (empty($_GET['id'])) {
            return [ 'message' => 'Отправьте id для поиска через get' ];
        }

        $data = $this->request->validate([
            'phone_number' => ['required', 'personPhone', 'unique:people_phones'],
        ]);

        if (isset($data['errors'])) {
            return [
                'message' => 'Валидация не пройдена',
                'errors' => $data['errors']
            ];
        }

        $result = $this->db->update('people_phones', $_GET['id'], $data);

        if(isset($result['error'])) {
            return ['error' => $result['error']];
        } else {
            return $result;
        }
    }
}