<?php

require_once './Controllers/HeladoController.php';
require_once './Controllers/VentaController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'altaHelado':
            $controller = new HeladoController();
            $controller->altaHelado();
            break;
        
        case 'consultarHelado':
            $controller = new HeladoController();
            $controller->consultarHelado();
            break;

        case 'altaVenta':
            $controller = new VentaController();
            $controller->altaVenta();
            break;

        default:
            echo json_encode(['error' => 'Acción no reconocida']);
            break;
    }
}
