<?php

require_once '../Models/VentaModel.php';

class VentaController{
    private $model;

    public function __construct(){
        $this->model = new VentaModel();
    }
    
    public function altaVenta() {
        $email = $_POST['email'];
        $sabor = $_POST['sabor'];
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['stock'];

        $imagenPath = '/ImagenesDeLaVenta/2024/' . $sabor . '_' . $tipo . '_' . strtok($email, '@') . '_' . date('YmdHis') . '.jpg';
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenPath);

        $resultado = $this->model->altaVenta($email, $sabor, $tipo, $cantidad, $imagenPath);
        echo json_encode(['resultado' => $resultado]);
    }
}