<?php

namespace Dwes\ProyectoVideoclub\Model;




class Dvd extends Soporte
{

    //CONSTRUCTOR
    public function __construct(
        private string $titulo = "",
        private int $numero = 0,
        private float $precio = 0,
        private String $idiomas = "",
        private String $formatPantalla = "",
    ) {
        parent::__construct($titulo, $numero, $precio);
    }

    //GETTERS & SETTERS
    public function getIdiomas(): string
    {
        return $this->idiomas;
    }
    public function getFormato(): string
    {
        return $this->formatPantalla;
    }


//METODOS 

    /**
     * Metodo que muestra un resumen de los datos del soporte
     */
    public function muestraResumen()
    {
        echo 'Película en DVD:<br>';
        parent::muestraResumen();
        echo
        '<br>Idiomas: ' . $this->idiomas .
            '<br>Formato Pantalla: ' . $this->formatPantalla;;
    }
}
