<?php
namespace Controllers;

require_once '../services/StudentService.php';

use Services\StudentService;

class StudentController {
    private $service;

    public function __construct() {
        $this->service = new StudentService();
    }

    public function index() {
        echo json_encode($this->service->getAll());
    }

    public function show($id) {
        echo json_encode($this->service->getById($id));
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($this->service->create($data));
    }

    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($this->service->update($id, $data));
    }

    public function destroy($id) {
        echo json_encode($this->service->delete($id));
    }
}
