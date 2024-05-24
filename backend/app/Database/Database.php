<?php 

namespace App\Database;

use App\Config\Config;
use PDO;
use PDOException;

class Database
{
    private $config;
    public $db;

    public function __construct()
    {
        $this->config = new Config();
        $this->db = $this->connect();
    }

    public function connect()
    {
        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        $database= $this->config->get('database.database');

        try {
            $pdo = new PDO("$driver:host=$host;dbname=$database;", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}