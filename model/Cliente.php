<?php 

class Cliente {
        
//CONSTRUCTOR
    public function __construct(
        private string $nombre = "",
        private int $numero = 0,
        private array $soportesAlquilados = [],
        private int $numSoportesAlquilados = 0,
        private int $maxAlquilerConcurrente = 3,
    ){}



//GETTERS & SETTERS

    public function getNumero():int{
        return $this->numero;
    }

    public function getNumSoportesAlquilados(){
        return $this->numSoportesAlquilados;
    } 

    public function setNumero(int $numero){
        $this->numero = $numero;
    }

//METODOS

    /**
     * Metodo que muestra el resumen del cliente
     */
    public function muestraResumen (){
        echo "El nombre del cliente es: " . $this->nombre . " y ha alquilado " . count($this->soportesAlquilados) . " soportes";
    }
}

?>