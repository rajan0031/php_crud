<?php
namespace Models;

require_once __DIR__ . '/../config/database.php';

class Student {
    private $conn;

    public function __construct() {
        $this->conn = getDBConnection();
    }

    public function all() {
        return $this->conn->query("SELECT * FROM students")->fetchAll();
    }

    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO students (name, email) VALUES (?, ?)");
        $stmt->execute([$data['name'], $data['email']]);
        return ['id' => $this->conn->lastInsertId()];
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE students SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$data['name'], $data['email'], $id]);
        return ['updated' => $stmt->rowCount()];
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->execute([$id]);
        return ['deleted' => $stmt->rowCount()];
    }
}
