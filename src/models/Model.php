<?php

namespace App\Models;

use App\Config\Database;
use PDO;

abstract class Model {
    protected $db;
    protected $table;
    protected $primaryKey = 'id';

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        $stmt = $this->db->query($sql, [$id]);
        return $stmt->fetch();
    }

    public function all() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function create(array $data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, array $data) {
        return $this->db->update(
            $this->table,
            $data,
            "{$this->primaryKey} = ?",
            [$id]
        );
    }

    public function delete($id) {
        return $this->db->delete(
            $this->table,
            "{$this->primaryKey} = ?",
            [$id]
        );
    }

    public function where($column, $operator, $value = null) {
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }

        $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} ?";
        $stmt = $this->db->query($sql, [$value]);
        return $stmt->fetchAll();
    }

    public function whereIn($column, array $values) {
        $placeholders = str_repeat('?,', count($values) - 1) . '?';
        $sql = "SELECT * FROM {$this->table} WHERE {$column} IN ({$placeholders})";
        $stmt = $this->db->query($sql, $values);
        return $stmt->fetchAll();
    }

    public function paginate($page = 1, $perPage = 10) {
        $offset = ($page - 1) * $perPage;
        
        // Get total records
        $totalSql = "SELECT COUNT(*) as total FROM {$this->table}";
        $totalStmt = $this->db->query($totalSql);
        $total = $totalStmt->fetch()['total'];
        
        // Get paginated records
        $sql = "SELECT * FROM {$this->table} LIMIT ? OFFSET ?";
        $stmt = $this->db->query($sql, [$perPage, $offset]);
        
        return [
            'data' => $stmt->fetchAll(),
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($total / $perPage)
        ];
    }

    public function orderBy($column, $direction = 'ASC') {
        $sql = "SELECT * FROM {$this->table} ORDER BY {$column} {$direction}";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function join($table, $first, $operator, $second, $type = 'INNER') {
        $sql = "SELECT * FROM {$this->table} {$type} JOIN {$table} ON {$first} {$operator} {$second}";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
} 