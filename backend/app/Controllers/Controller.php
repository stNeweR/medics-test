<?php 

namespace App\Controllers;

use App\Database\Database;
use Kernel\Http\Request;
use Kernel\Http\Validator;

class Controller 
{
    public $db;
    public $request;

    public function __construct()
    {
        $this->db = new Database();
        $this->request = new Request();
    }
}