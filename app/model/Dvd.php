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
     * @param int $duracion Duración de la película en minutos.
     * @param string $idiomas Lista de idiomas disponibles en el DVD.
     * @param string $formatPantalla Formato de visualización de pantalla.
     * @param string $metacritic URL de Metacritic.
     */
    public function __construct(
        string $titulo = "",
        int $numero = 0,
        float $precio = 0,
        private int $duracion = 0,
        private String $idiomas = "",
        private String $formatPantalla = "",
        string $metacritic = ""
    ) {
        parent::__construct($titulo, $numero, $precio, false, $metacritic);
    }

    //GETTERS & SETTERS
    /**
     * Obtiene la duración del DVD
     * @return int Duración en minutos
     */
    public function getDuracion(): int
    {
        return $this->duracion;
    }

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
     * @return string Resumen del DVD
     */
    public function muestraResumen(): string {
    $mensaje = 'Película en DVD:<br>';
    $mensaje .= parent::muestraResumen();
    $mensaje .= '<br>Duración: ' . $this->duracion . " minutos";
    $mensaje .= '<br>Idiomas: ' . $this->idiomas . '<br>Formato Pantalla: ' . $this->formatPantalla;
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
