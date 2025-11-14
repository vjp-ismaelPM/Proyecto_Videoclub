<?php

namespace Dwes\ProyectoVideoclub\Model;

include_once(__DIR__ . '/../../autoload.php');

class CintaVideo extends Soporte{
    
//CONSTRUCTOR
    public function __construct(
        private string $titulo = "",
        private int $numero = 0,
        private float $precio = 0,
        private int $duracion = 0
    ){
        parent::__construct($titulo,$numero,$precio);
    }

//METODOS 

    /**
     * Metodo que muestra un resumen de los datos del soporte
     */
    public function muestraResumen(){
        echo'Película en VHS:<br>';
        parent::muestraResumen();
        echo'<br>Duración: ' . $this->duracion . " minutos";
    }
}

?>