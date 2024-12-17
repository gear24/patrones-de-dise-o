<?php

#initerfaz pal 7GOD
interface Windows7Archivo {
    public function abrirArchivoWindows7();
}

#interfaz pa w10
interface Windows10Archivo {
    public function abrirArchivo();
}

#implementacion de archivo de w7
class MicrosoftOfficeWindows7 implements Windows7Archivo {
    public function abrirArchivoWindows7() {
        return "Archivo abierto en Windows 7";
    }
}

#el adaptador
class ArchivoAdapter implements Windows10Archivo {
    private $windows7Archivo;

    public function __construct(Windows7Archivo $archivo) {
        $this->windows7Archivo = $archivo;
    }

    public function abrirArchivo() {
        return $this->windows7Archivo->abrirArchivoWindows7() . 
               " (Adaptado para Windows 10)";
    }
}

#user
$archivoWindows7 = new MicrosoftOfficeWindows7();
$adaptador = new ArchivoAdapter($archivoWindows7);

echo $adaptador->abrirArchivo() . "\n";
