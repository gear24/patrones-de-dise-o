<?php

#interfa
interface EstrategiaMensaje {
    public function mostrar(string $mensaje);
}

#salida por consola
class SalidaConsola implements EstrategiaMensaje {
    public function mostrar(string $mensaje) {
        echo "Consola: $mensaje\n";
    }
}

#pa json
class SalidaJSON implements EstrategiaMensaje {
    public function mostrar(string $mensaje) {
        $json = json_encode(['mensaje' => $mensaje]); #hasta codificado papa!
        #https://www.php.net/manual/en/function.json-encode.php
        echo "JSON: $json\n";
    }
}

#pa txt
class SalidaArchivo implements EstrategiaMensaje {
    private $nombreArchivo;

    public function __construct(string $nombreArchivo) {
        $this->nombreArchivo = $nombreArchivo;
    }

    public function mostrar(string $mensaje) {
        file_put_contents($this->nombreArchivo, $mensaje, FILE_APPEND); #pa que parezca mas real
        #https://www.php.net/manual/en/function.file-put-contents.php
        echo "Archivo: Mensaje guardado en {$this->nombreArchivo}\n";
    }
}

#estrategia estrategicamente usada
class MensajeSistema {
    private $estrategia;

    public function establecerEstrategia(EstrategiaMensaje $estrategia) {
        $this->estrategia = $estrategia;
    }

    public function mostrarMensaje(string $mensaje) {
        if ($this->estrategia === null) {
            throw new Exception("No se ha establecido una estrategia de salida");
        }
        $this->estrategia->mostrar($mensaje);
    }
}

#uso
$sistema = new MensajeSistema();

#consola
$sistema->establecerEstrategia(new SalidaConsola());
$sistema->mostrarMensaje("Hola, este es un mensaje de prueba");

#json
$sistema->establecerEstrategia(new SalidaJSON());
$sistema->mostrarMensaje("Mensaje en formato JSON");

#archivo
$sistema->establecerEstrategia(new SalidaArchivo("mensajes.txt"));
$sistema->mostrarMensaje("Mensaje guardado en archivo de texto");
