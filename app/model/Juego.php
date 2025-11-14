<?php
namespace Dwes\ProyectoVideoclub\Model;


include_once(__DIR__ . '/../../autoload.php');

class Juego extends Soporte {

//CONSTRUCTOR
    public function __construct(
        private string $titulo = "",
        private int $numero = 0,
        private float $precio = 0,
        private String $consola = "",
        private int $minJugadores = 0,
        private int $maxJugadores = 0,
    ){
        parent::__construct($titulo,$numero,$precio);
    }

//METODOS

    /**
     * Metodo que retorna un String para saber si el juego es de un solo jugador o de varios
     */
    public function muestraJugadoresPosibles(){
        $jugadoresTotales = "";
        if($this->minJugadores == 1 && $this->maxJugadores == 1){
            $jugadoresTotales = "Para un jugador";
        }else if($this->minJugadores == $this->maxJugadores) {
            $jugadoresTotales = "Para " . $this->maxJugadores . " jugadores";
        }else{
            $jugadoresTotales = "De " . $this->minJugadores . " a " . $this->maxJugadores . " jugadores";
        }
        return $jugadoresTotales;
    }

    /**
     * Metodo que muestra un resumen de los datos del soporte
     */
    public function muestraResumen(){
        echo'Juego para:' . $this->consola . '<br>';
        parent::muestraResumen();
        echo
            '<br>' . $this->muestraJugadoresPosibles();
        ;
    }

}

?>