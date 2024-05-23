<?php 

namespace App\Controllers;

class UserController
{
    public function index()
    {
        return [
            'data' => $_GET 
        ];
    }
}