<?php
class Router {
    public static function route($method, $uri) {
        // Procesar la URL 
        $uri = trim(parse_url($uri, PHP_URL_PATH), '/');
        $uriParts = explode('/', $uri);


        //RUTA
        if (count($uriParts) > 1 && $uriParts[0] === 'mi_api_donantes' && $uriParts[1] === 'donantes') {
            require '../app/controllers/DonanteController.php';
            $controller = new DonanteController();

            switch ($method) {
                case 'GET':
                    if (isset($uriParts[2])) {
                        $controller->getById($uriParts[2]);
                    } else {
                        $controller->getAll();
                    }
                    break;
                case 'POST':
                    $controller->create();
                    break;
                case 'PUT':
                    $controller->update($uriParts[2]);
                    break;
                case 'DELETE':
                    $controller->delete($uriParts[2]);
                    break;
                default:
                    http_response_code(405);
                    echo json_encode(['ATENCIÓN' => 'Método no permitido']);
                    break;
            }
        } else {
            http_response_code(404);
            echo json_encode(['ATENCIÓN' => 'Ruta no encontrada']);
        }
    }
}

