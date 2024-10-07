<?php
require_once '../Models/HeladoModel.php';

class VentaModel{
    private $archivoJson = 'ventas.json';

    public function obtenerVentas(){
        if (!file_exists($this->archivoJson)) {
            return [];
        }
        
        return json_decode(file_get_contents($this->archivoJson), true);

    }
    public function guardarVenta($nuevaVenta){
        $ventas = $this->obtenerVentas();
        $ventas[] = $nuevaVenta; 
        
        $ventas = array_filter($ventas, function($venta) {
            return $venta !== null;
        });
    
        file_put_contents($this->archivoJson, json_encode(array_values($ventas), JSON_PRETTY_PRINT));

    }
    
    public function altaVenta($email, $sabor, $tipo, $cantidad, $imagenPath) {
        $heladoModel = new HeladoModel();
    
        if ($heladoModel->actualizarStock($sabor, $tipo, $cantidad)) {
            $id = rand(1, 10000);
            $fecha = date('d-m-Y');
            $pedido = [
                'id' => $id,
                'email' => $email,
                'sabor' => $sabor,
                'tipo' => $tipo,
                'cantidad' => $cantidad,
                'fecha' => $fecha,
                'imagen' => $imagenPath
            ];
    
            $this->guardarVenta($pedido);
    
            return "Venta registrada con exito";
        }
    
        return "No hay suficiente stock";
    }
    
    public function consultarHelado(){
    }
    public function contarHeladosVendidos($fecha){
        $ventas = $this->obtenerVentas();
        $cantidad = 0;

        foreach ($ventas as $venta){
            if (date('d-m-Y', strtotime($venta['fecha'])) === $fecha) {
                $cantidad++;
            }
        }
        return $cantidad;
    }
    public function obtenerVentasPorUsuario($email){
        $ventas = $this->obtenerVentas();
        $resultados = [];

        foreach ($ventas as $venta) {
            if (isset($venta['email']) && $venta['email'] === $email) {
                $resultados[] = $venta;
            }
        }
        return $resultados;
    }

}