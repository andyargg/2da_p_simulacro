<!-- HeladeriaAlta.php: (por POST) se ingresa Sabor, Precio, Tipo (“Agua” o “Crema”), Vaso (“Cucurucho”,
“Plástico”), Stock (unidades).
Se guardan los datos en en el archivo de texto heladeria.json, tomando un id autoincremental como
identificador(emulado) .Sí el nombre y tipo ya existen , se actualiza el precio y se suma al stock existente.
completar el alta con imagen del helado, guardando la imagen con el sabor y tipo como identificación en la
carpeta /ImagenesDeHelados/2024. -->
<?php

class HeladoModel{
    private $archivoJson = 'heladeria.json';

    public function obtenerHelados(){
        if (!file_exists($this->archivoJson)){
            return [];
        }
        return json_decode(file_get_contents($this->archivoJson), true);
    }
    public function guardarHelados($helados) {
        $helados = array_filter($helados, function($helado) {
            return $helado !== null;
        });
    
        // Guarda solo los helados válidos en el archivo JSON
        file_put_contents($this->archivoJson, json_encode(array_values($helados)));
    }
    

    public function altaHelado($sabor, $precio, $tipo, $vaso, $stock, $imagenPath){
        $helados = $this->obtenerHelados();
        $id = count($helados) + 1;

        foreach($helados as $helado){
            if ($helado['sabor'] === $sabor && $helado['tipo'] === $tipo){
                $helado['precio'] = $precio;
                $helado['stock'] += $stock;
                $this->guardarHelados($helados);
                return 'helado actualizado';
            }
        }

        $nuevoHelado = [
            'id' => $id,
            'sabor' => $sabor,
            'precio' => $precio,
            'tipo' => $tipo,
            'vaso' => $vaso,
            'stock' => $stock,
            'imagen' => $imagenPath
        ];

        $helados[] = $nuevoHelado;
        $this->guardarHelados($helados);
        return "Helado agregado";
    }

    public function consultarHelado($sabor, $tipo){
        $helados = $this->obtenerHelados();

        foreach ($helados as $helado){
            if ($helado['sabor'] === $sabor && $helado['tipo'] === $tipo){
                return true;
            }
        }
        return false;
    }

    public function actualizarStock($sabor, $tipo, $cantidad) {
        $helados = $this->obtenerHelados();
        foreach ($helados as &$helado) {
            if ($helado['sabor'] === $sabor && $helado['tipo'] === $tipo && $helado['stock'] >= $cantidad) {
                $helado['stock'] -= $cantidad;
                $this->guardarHelados($helados);
                return true;
            }
        }
        return false;
    }
}

