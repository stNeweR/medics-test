<?php 

namespace App\Controllers;
use App\Database\Database;
use App\Controllers\Controller;

class UserController extends Controller 
{
    public function index()
    {
        return [
            'data' => $_GET['id']
        ];
    }
}