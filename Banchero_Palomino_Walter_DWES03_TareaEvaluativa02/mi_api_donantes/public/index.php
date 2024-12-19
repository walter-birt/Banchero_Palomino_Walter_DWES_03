<?php
require '../app/core/router.php';

// Llama al enrutador para procesar la solicitud
Router::route($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);



