<?php 

include_once("Soporte.php");

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

    public function actualizarNumSoportesAlquilados(){
        $this->numSoportesAlquilados = count($this->soportesAlquilados);
    }

    /**
     * Metodo que muestra el resumen del cliente
     */
    public function muestraResumen (){
        echo "El nombre del cliente es: " . $this->nombre . " y ha alquilado " . count($this->soportesAlquilados) . " soportes";
    }

    /**
     * Comprueba si un cliente tiene alquilado un soporte específico.
     *
     * @return bool Devuelve true si el soporte está alquilado por el cliente, 
     *              false en caso contrario.
     */
    public function tieneAlquilado(Soporte $soporte):bool{
        $soporteEncontrado = false;
        $i = 0;
        while (!$soporteEncontrado && $i < $this->getNumSoportesAlquilados()) {
            $soporteAlquilado = $this->soportesAlquilados[$i];
            $soporteEncontrado = $soporteAlquilado->getTitulo() === $soporte->getTitulo();
            $i++;
        }
        return $soporteEncontrado;
    }

    public function alquilar(Soporte $s): bool{
        $alquilado = false;
        $errores = "";
        if($this->getNumSoportesAlquilados() < $this->maxAlquilerConcurrente){

            if(!$this->tieneAlquilado($s)){

                $this->soportesAlquilados[] = $s;
                $this->actualizarNumSoportesAlquilados();
                $alquilado = true;
                echo "<p>Alquilado soporte a: <strong>" . $this->nombre . "</strong></p>";
                $s->muestraResumen();

            }else{
               $errores .= "El cliente ya tiene alquilado el soporte <strong>" . $s->getTitulo() . "</strong><br>";
            }

        }else{
            $errores .= "Este cliente (" . $this->nombre . ") tiene " . $this->getNumSoportesAlquilados() . " elementos alquilados. No puede alquilar más en este videoclub hasta que no devuelva algo<br>";
        }

        if($errores !== "" ){
            echo $errores;
        }

        return $alquilado;
    }
}

?>