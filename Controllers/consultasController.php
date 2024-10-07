<?php
require_once '../Models/VentaModel.php';

class consultasVentasController{
    private $model;

    public function __construct(){
        $this->model = new VentaModel();
    }

    public function consultarHeladosVendidos(){

        if (isset($_GET['fecha']) && !empty($_GET['fecha'])){
            $fecha = $_GET['fecha'];
        } else{
            $fecha = date('Y-m-d', strtotime('-1 day'));
        }
        $cantidadVendidos = $this->model->contarHeladosVendidos($fecha);
        
        echo json_encode(['fecha' => $fecha, 'cantidad_vendidos' => $cantidadVendidos]);
    }
    public function listarVentasPorUsuario() {
        $email = $_GET['email'] ?? '';

        if (empty($email)) {
            echo json_encode(['error' => 'El email es requerido']);
            return;
        }

        $ventas = $this->model->obtenerVentasPorUsuario($email);
        echo json_encode($ventas);
    }
}