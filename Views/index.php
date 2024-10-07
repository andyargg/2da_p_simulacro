<?php

require_once '../Controllers/HeladoController.php';

require_once '../Controllers/VentaController.php';

require_once '../Controllers/ConsultasController.php'; 


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
            echo json_encode(['error' => 'Accion no reconocida']);
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';
    switch ($action) {
        case 'consultarCantidadHeladosVendidos':
            $controller = new ConsultasVentasController();
            $controller->consultarHeladosVendidos(); 
            break;
        
        case 'listarVentasPorUsuario';
            $controller = new ConsultasVentasController();
            $controller->listarVentasPorUsuario();
            break;
            
        default:
            echo json_encode(['error' => 'Accion no reconocida']);
            break;
    }
} 
