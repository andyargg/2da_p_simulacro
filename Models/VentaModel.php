<?php
require_once '../Models/HeladoModel.php';

class VentaModel{
    public function altaVenta($email, $sabor, $tipo, $cantidad, $imagenPath){
        $heladoModel = new HeladoModel();

        if ($heladoModel->actualizarStock($sabor, $tipo, $cantidad)){
            $id = rand(1,10000);
            $fecha = date('Y-m-d H:i:s');
            $pedido = [
                'id' => $id,
                'email' => $email,
                'sabor' => $sabor,
                'tipo' => $tipo,
                'cantidad' => $cantidad,
                'fecha' => $fecha,
                'imagen' => $imagenPath
            ];
            return "Venta registrada con éxito";
        }
        return "No hay suficiente stock";
    }

}