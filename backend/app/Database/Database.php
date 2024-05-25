<?php 

namespace App\Database;

use App\Config\Config;
use MongoDB\Driver\Exception\Exception;
use MongoDB\Driver\Exception\ExecutionTimeoutException;
use PDO;
use PDOException;
use PDOStatement;

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

    public function get(string $table, array $params = [])
    {
        $sql = "SELECT * FROM $table";

        if (!empty($params)) {
            $whereClaus = [];
            $binds = [];

            foreach ($params as $key => $value) {
                $whereClaus[] = "$key = ?";
                $binds[] = $value;
            }

            $sql .= " WHERE " . implode(" AND ", $whereClaus);
        } else {
            $binds = [];
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute($binds);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert(string $table, array $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array_values($data));
            return ['message' => 'Пользователь успешно добавлен'];
        } catch (\Exception $e) {
            return [ 'error' => $e->getMessage() ];
        }
    }

    public function delete(string $table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = :id";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return [ 'message' => 'Пользователь удален' ];
            } else {
                return [ 'error' => 'Нет пользователя с таким id' ];
            }
        } catch (\Exception $e) {
            return [ 'error' => $e->getMessage() ];
        }
    }
}