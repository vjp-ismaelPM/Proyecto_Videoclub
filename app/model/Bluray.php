<?php

namespace Dwes\ProyectoVideoclub\Model;

/**
 * Clase que representa un Bluray.
 * Hereda de Soporte.
 * 
 * @package Dwes\ProyectoVideoclub\Model
 */
class Bluray extends Soporte
{
    /**
     * Constructor de la clase Bluray.
     * 
     * @param string $titulo Título de la película.
     * @param int $numero Número identificador.
     * @param float $precio Precio de alquiler.
     * @param int $duracion Duración en minutos.
     * @param bool $is4k Si es 4K o no.
     * @param string $metacritic URL de Metacritic.
     */
    public function __construct(
        string $titulo,
        int $numero,
        float $precio,
        private int $duracion,
        private bool $is4k,
        string $metacritic = ""
    ) {
        parent::__construct($titulo, $numero, $precio, false, $metacritic);
    }

    /**
     * Obtiene la duración de la película.
     * @return int Duración en minutos
     */
    public function getDuracion(): int
    {
        return $this->duracion;
    }

    /**
     * Indica si el Bluray es 4K.
     * @return bool True si es 4K, false si no.
     */
    public function is4k(): bool
    {
        return $this->is4k;
    }

    /**
     * Muestra por pantalla un resumen de los datos del Bluray.
     * 
     * @return string Resumen del Bluray
     */
    public function muestraResumen(): string
    {
        $mensaje = 'Película en Bluray:<br>';
        $mensaje .= parent::muestraResumen();
        $mensaje .= '<br>Duración: ' . $this->duracion . " minutos";
        $mensaje .= '<br>Resolución: ' . ($this->is4k ? '4K' : 'HD');
        
        echo $mensaje;
        return $mensaje;
    }

    /**
     * Obtiene la puntuación de Metacritic.
     * 
     * @return int|null Puntuación o null.
     */
    public function getPuntuacion(): ?int
    {
        if (empty($this->metacritic)) {
            return null;
        }
        return \Dwes\ProyectoVideoclub\Util\MetacriticScraper::getMetascore($this->metacritic);
    }
}
