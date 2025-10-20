<?php
namespace Dwes\ProyectoVideoclub;

include_once("Soporte.php");

class Dvd extends Soporte{
       
//CONSTRUCTOR
    public function __construct(
        private string $titulo = "",
        private int $numero = 0,
        private float $precio = 0,
        private String $idiomas = "",
        private String $formatPantalla = "",
    ){
        parent::__construct($titulo,$numero,$precio);
    }

//METODOS 

    /**
     * Metodo que muestra un resumen de los datos del soporte
     */
    public function muestraResumen(){
        echo'Película en DVD:<br>';
        parent::muestraResumen();
        echo
            '<br>Idiomas: ' . $this->idiomas . 
            '<br>Formato Pantalla: ' . $this->formatPantalla ;
        ;
    }
}

?>