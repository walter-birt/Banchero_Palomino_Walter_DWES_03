<?php
require __DIR__ . '/../models/Donante.php';

class DonanteController {
    private $model;

    public function __construct() {
        $this->model = new Donante();
    }
    //Obtener todos los donantes
    public function getAll() {
        $donantes = $this->model->getAll();
        echo json_encode($donantes);
    }
    //Obtener donante por id
    public function getById($id) {
        $donante = $this->model->getById($id);
        if ($donante) {
            echo json_encode($donante);
        } else {
            http_response_code(404);
            echo json_encode(['ATENCIÓN' => 'Donante no encontrado']);
        }
    }
    //Crear donante
    public function create() {
        $newDonante = json_decode(file_get_contents('php://input'), true);
        if ($newDonante) {
            $this->model->create($newDonante);
            http_response_code(201);
            echo json_encode(['OK' => 'Donante creado exitosamente']);
        } else {
            http_response_code(400);
            echo json_encode(['ERROR' => 'Datos invalidos']);
        }
    }
    //Actualizar donante
    public function update($id) {
        $updatedDonante = json_decode(file_get_contents('php://input'), true);
        if ($updatedDonante) {
            $result = $this->model->update($id, $updatedDonante);
            if ($result) {
                echo json_encode(['ESTADO' => 'Donante actualizado exitosamente']);
            } else {
                http_response_code(404);
                echo json_encode(['ATENCIÓN' => 'Donante no encontrado']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['ERROR' => 'Datos inválidos']);
        }
    }
    //Borrar donante
    public function delete($id) {
        $result = $this->model->delete($id);
        if ($result) {
            echo json_encode(['OK' => 'Donante eliminado exitosamente']);
        } else {
            http_response_code(404);
            echo json_encode(['ATENCIÓN' => 'Donante no encontrado']);
        }
    }
}


