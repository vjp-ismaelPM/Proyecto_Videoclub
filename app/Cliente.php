<?php 
namespace Dwes\ProyectoVideoclub;

include_once(__DIR__ . '/../autoload.php');

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

    public function getNombre():string{
        return $this->nombre;
    }

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
     * Metodo que actualiza el numero de soportes alquilados
     */
    public function actualizarNumSoportesAlquilados(){
        $this->numSoportesAlquilados = count($this->soportesAlquilados);
    }

    /**
     * Metodo que muestra el resumen del cliente
     */
    public function muestraResumen (){
        echo "<p>El nombre del cliente es: " . $this->nombre . " y ha alquilado " . count($this->soportesAlquilados) . " soportes</p>";
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

    /**
     * Comprueba si se puede alquilar el soporte pasado por parametros, se comprueba que no tenga más del maximo y que no sea repetido
     * 
     * @param Soporte $s Es el soporte a comprobar para alquilarlo
     * @return bool Devuelve true si el soporte se ha podido alquilar, false en caso contrario
     */
    public function alquilar(Soporte $s): bool{
        $alquilado = false;
        $errores = "";
        if(!$this->tieneAlquilado($s)){

            if($this->getNumSoportesAlquilados() < $this->maxAlquilerConcurrente){

                $this->soportesAlquilados[] = $s;
                $this->actualizarNumSoportesAlquilados();
                $alquilado = true;
                echo "<p><strong>Alquilado soporte a: </strong>" . $this->nombre . "</p>";
                $s->muestraResumen();

            }else{
               $errores .= "<p>Este cliente (<strong>" . $this->nombre . "</strong>) tiene " . $this->getNumSoportesAlquilados() . " elementos alquilados. No puede alquilar más en este videoclub hasta que no devuelva algo</p>";
            }

        }else{
            $errores .= "<p>El cliente ya tiene alquilado el soporte <strong>" . $s->getTitulo() . "</strong></p>";
        }

        if($errores !== "" ){
            echo $errores;
        }

        return $alquilado;
    }

    /**
     * Comprueba si se puede devolver el soporte pasado por parametros, se comprueba que la posicion pasada no se exceda del numero de soportes alquilados
     * 
     * @param int $numSoporte Es la posicion del soporte a devolver
     * @return bool Devuelve true si el soporte se ha podido devolver, false en caso contrario
     */
    public function devolver(int $numSoporte):bool{
        $devuelto = false;
        $errores = "";
        if($numSoporte < $this->numSoportesAlquilados){
                $soporteAux = $this->soportesAlquilados[$numSoporte];
                unset($this->soportesAlquilados[$numSoporte]);
                $this->soportesAlquilados = array_values($this->soportesAlquilados);
                $this->actualizarNumSoportesAlquilados();
                $devuelto = true;
                echo "<p>Se ha devuelto el soporte seleccionado (" . $soporteAux->getTitulo() . ")</p>";
        }else{
            $errores .= "<p>No se ha podido encontrar el soporte en los alquileres de este cliente(<strong>" . $this->nombre . "</strong>)</p>";
        }
        
        if($errores !== "" ){
            echo $errores;
        }

        return $devuelto;
    }

    /**
     * Metodo que imprime por panta los soportes alquilado en caso de que el usuario tenga alquilado alguno
     */
    public function listarAlquileres(){
        if($this->numSoportesAlquilados != 0){
            echo "<p><strong>El cliente(" . $this->nombre . ") tiene " . $this->numSoportesAlquilados . " soportes alquilados</strong></p>";
            foreach($this->soportesAlquilados as $soporte){
                
                echo "<p>" . $soporte->muestraResumen() . "</p>";
            }
        }else{
            echo "<p>Este cliente(" . $this->nombre . ") no tiene alquilado ningún elemento</p>";
        }
    }
}

?>