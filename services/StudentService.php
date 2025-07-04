<?php
namespace Services;

require_once __DIR__ . '/../models/Student.php';

use Models\Student;

class StudentService {
    private $model;

    public function __construct() {
        $this->model = new Student();
    }

    public function getAll() {
        return $this->model->all();
    }

    public function getById($id) {
        return $this->model->find($id);
    }

    public function create($data) {
        return $this->model->create($data);
    }

    public function update($id, $data) {
        return $this->model->update($id, $data);
    }

    public function delete($id) {
        return $this->model->delete($id);
    }
}
