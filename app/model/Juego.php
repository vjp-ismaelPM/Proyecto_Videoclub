<?php

namespace Dwes\ProyectoVideoclub\Model;




/**
 * Clase que representa un Juego.
 * Hereda de Soporte.
 * 
 * @package Dwes\ProyectoVideoclub\Model
 */
class Juego extends Soporte
{

    //CONSTRUCTOR
    /**
     * Constructor de la clase Juego.
     * 
     * @param string $titulo Título del videojuego.
     * @param int $numero Número identificador único.
     * @param float $precio Precio base de alquiler.
     * @param string $consola Nombre de la consola para la que es el juego.
     * @param int $minJugadores Número mínimo de jugadores permitidos.
     * @param int $maxJugadores Número máximo de jugadores permitidos.
     * @param string $metacritic URL de Metacritic.
     */
    public function __construct(
        string $titulo = "",
        int $numero = 0,
        float $precio = 0,
        private String $consola = "",
        private int $minJugadores = 0,
        private int $maxJugadores = 0,
        string $metacritic = ""
    ) {
        parent::__construct($titulo, $numero, $precio, false, $metacritic);
    }

    //GETTERS & SETTERS
    /**
     * Obtiene la consola
     * @return string Consola
     */
    public function getConsola(): string
    {
        return $this->consola;
    }

    /**
     * Obtiene el mínimo de jugadores
     * @return int Mínimo de jugadores
     */
    public function getMinJugadores(): int
    {
        return $this->minJugadores;
    }

    /**
     * Obtiene el máximo de jugadores
     * @return int Máximo de jugadores
     */
    public function getMaxJugadores(): int
    {
        return $this->maxJugadores;
    }

//METODOS

    /**
     * Retorna un String para saber si el juego es de un solo jugador o de varios
     * 
     * @return string Descripción de jugadores posibles
     */
    public function muestraJugadoresPosibles()
    {
        $jugadoresTotales = "";
        if ($this->minJugadores == 1 && $this->maxJugadores == 1) {
            $jugadoresTotales = "Para un jugador";
        } else if ($this->minJugadores == $this->maxJugadores) {
            $jugadoresTotales = "Para " . $this->maxJugadores . " jugadores";
        } else {
            $jugadoresTotales = "De " . $this->minJugadores . " a " . $this->maxJugadores . " jugadores";
        }
        return $jugadoresTotales;
    }

    /**
     * Muestra por pantalla un resumen de los datos del juego,
     * incluyendo la consola y el número de jugadores posibles.
     * 
     * @return string Resumen del juego
     */
    public function muestraResumen(): string {
    $mensaje = 'Juego para:' . $this->consola . '<br>';
    $mensaje .= parent::muestraResumen();
    $mensaje .= '<br>' . $this->muestraJugadoresPosibles();
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
