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

        $directory ='/1ra_parte_simulacro/ImagenesDeLaVenta/2024/';
        
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);  
        }

        // Ruta absoluta para la imagen
        $imagenPath = $directory . $sabor . '_' . $tipo . '_' . strtok($email, '@') . '_' . date('d-m-Y') . '.jpg';

        // Mover el archivo subido a la carpeta correspondiente
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenPath)) {
            $resultado = $this->model->altaVenta($email, $sabor, $tipo, $cantidad, $imagenPath);
            echo json_encode(['resultado' => $resultado]);
        } else {
            echo json_encode(['resultado' => 'Error al subir la imagen']);
        }
    }
}
