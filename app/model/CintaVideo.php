<?php

namespace Dwes\ProyectoVideoclub\Model;



/**
 * Clase que representa una cinta de video.
 * Hereda de Soporte.
 * 
 * @package Dwes\ProyectoVideoclub\Model
 */
class CintaVideo extends Soporte
{

    //CONSTRUCTOR
    /**
     * Constructor de la clase CintaVideo.
     * 
     * @param string $titulo Título de la cinta de video.
     * @param int $numero Número identificador único.
     * @param float $precio Precio base de alquiler.
     * @param int $duracion Duración de la película en minutos.
     */
    public function __construct(
        private string $titulo = "",
        private int $numero = 0,
        private float $precio = 0,
        private int $duracion = 0
    ) {
        parent::__construct($titulo, $numero, $precio);
    }

    //GETTERS & SETTERS
    /**
     * Obtiene la duración de la cinta
     * @return int Duración en minutos
     */
    public function getDuracion(): int
    {
        return $this->duracion;
    }


//METODOS 

    /**
     * Muestra por pantalla un resumen de los datos de la cinta de video,
     * incluyendo la duración de la misma.
     * 
     * @return void
     */
    public function muestraResumen()
    {
        echo 'Película en VHS:<br>';
        parent::muestraResumen();
        echo '<br>Duración: ' . $this->duracion . " minutos";
    }
}
