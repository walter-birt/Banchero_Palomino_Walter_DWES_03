<?php
class Donante {
    private $dataFile;
    public function __construct() { 
        $this->dataFile = __DIR__ . '/../data/donantes.json';
    }
    //Visualizar todos los donantes
    public function getAll() {
        return json_decode(file_get_contents($this->dataFile), true);
    }
    //Buscar donante por id
    public function getById($id) {
        $donantes = $this->getAll();
        foreach ($donantes as $donante) {
            if ($donante['id'] == $id) {
                return $donante;
            }
        }
        return null;
    }

    // Crear nuevo donante
    public function create($newDonante) {
        $donantes = $this->getAll();
        $donantes[] = $newDonante;
        file_put_contents($this->dataFile, json_encode($donantes));
    }

    // Actualizar datos donante
    public function update($id, $updatedDonante) {
        $donantes = $this->getAll();
        foreach ($donantes as &$donante) {
            if ($donante['id'] == $id) {
                // Asignar manualmente los nuevos valores
                if (isset($updatedDonante['nombre'])) {
                    $donante['nombre'] = $updatedDonante['nombre'];
                }
                if (isset($updatedDonante['apellido'])) {
                    $donante['apellido'] = $updatedDonante['apellido'];
                }
                // Añadir más campos aquí según sea necesario
                if (isset($updatedDonante['grupo_sanguineo'])) {
                    $donante['grupo_sanguineo'] = $updatedDonante['grupo_sanguineo'];
                }
                if (isset($updatedDonante['contacto'])) {
                    $donante['contacto'] = $updatedDonante['contacto'];
                }
                if (isset($updatedDonante['ultima_donacion'])) {
                    $donante['ultima_donacion'] = $updatedDonante['ultima_donacion'];
                }

                file_put_contents($this->dataFile, json_encode($donantes));
                return true;
            }
        }
        return false;
    }


//Borrar donante
    public function delete($id) {
        $donantes = $this->getAll();
        foreach ($donantes as $key => $donante) {
            if ($donante['id'] == $id) {
                unset($donantes[$key]);
                file_put_contents($this->dataFile, json_encode(array_values($donantes)));
                return true;
            }
        }
        return false;
    }
}


