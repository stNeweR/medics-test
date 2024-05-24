<?php 

namespace App\Controllers;

use App\Config\ConfigInterface;
use App\Database\Database;
use App\Database\DatabaseInterface;

class Controller 
{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    } 
}