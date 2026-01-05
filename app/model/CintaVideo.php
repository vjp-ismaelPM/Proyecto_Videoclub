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
     * @param string $metacritic URL de Metacritic.
     */
    public function __construct(
        string $titulo = "",
        int $numero = 0,
        float $precio = 0,
        private int $duracion = 0,
        string $metacritic = ""
    ) {
        parent::__construct($titulo, $numero, $precio, false, $metacritic);
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
     * @return string Resumen de la cinta de video
     */
    public function muestraResumen(): string {
    $mensaje = 'Película en VHS:<br>';
    $mensaje .= parent::muestraResumen();
    $mensaje .= '<br>Duración: ' . $this->duracion . " minutos";
    echo $mensaje;
    return $mensaje;
}

    /**
     * Obtiene la puntuación de Metacritic mediante web scraping.
     * 
     * @return int|null Puntuación de Metacritic o null si no está disponible.
     */
    public function getPuntuacion(): ?int
    {
        if (empty($this->metacritic)) {
            return null;
        }
        return \Dwes\ProyectoVideoclub\Util\MetacriticScraper::getMetascore($this->metacritic);
    }
}
