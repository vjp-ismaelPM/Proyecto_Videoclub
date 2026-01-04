<?php

namespace Dwes\ProyectoVideoclub\Model;




/**
 * Clase que representa un DVD.
 * Hereda de Soporte.
 * 
 * @package Dwes\ProyectoVideoclub\Model
 */
class Dvd extends Soporte
{

    //CONSTRUCTOR
    /**
     * Constructor de la clase Dvd.
     * 
     * @param string $titulo Título de la película en DVD.
     * @param int $numero Número identificador único.
     * @param float $precio Precio base de alquiler.
     * @param string $idiomas Lista de idiomas disponibles en el DVD.
     * @param string $formatPantalla Formato de visualización de pantalla.
     */
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
    /**
     * Obtiene los idiomas disponibles
     * @return string Idiomas
     */
    public function getIdiomas(): string
    {
        return $this->idiomas;
    }

    /**
     * Obtiene el formato de pantalla
     * @return string Formato de pantalla
     */
    public function getFormato(): string
    {
        return $this->formatPantalla;
    }


//METODOS 

    /**
     * Muestra por pantalla un resumen de los datos del DVD,
     * incluyendo los idiomas y el formato de pantalla.
     * 
     * @return void
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
