<?php 

namespace Dwes\ProyectoVideoclub\Model;


use Dwes\ProyectoVideoclub\Model\Util\CupoSuperadoException;
use Dwes\ProyectoVideoclub\Model\Util\SoporteNoEncontradoException;
use Dwes\ProyectoVideoclub\Model\Util\SoporteYaAlquiladoException;
use Monolog\Logger;
use Dwes\ProyectoVideoclub\Util\LogFactory;




class Cliente{
        
    private Logger $logger;

//CONSTRUCTOR
    public function __construct(
        private string $nombre = "",
        private string $usuario = "",      
        private string $password = "", 
        private int $numero = 0,
        private array $soportesAlquilados = [],
        private int $numSoportesAlquilados = 0,
        private int $maxAlquilerConcurrente = 3,
    ){
        $this->logger = new Logger('VideoclubLogger');
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/videoclub.log', Level::Debug));
    }



//GETTERS & SETTERS

    public function getNombre():string{
        return $this->nombre;
    }

    public function getUsuario():string{
        return $this->usuario;
    }

    public function getPassword():string{
        return $this->password;
    }

    public function getNumero():int{
        return $this->numero;
    }

    public function getSoportesAlquilados(){
        return $this->soportesAlquilados;
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
    public function alquilar(Soporte $s){
        if(!$this->tieneAlquilado($s)){

            if($this->getNumSoportesAlquilados() < $this->maxAlquilerConcurrente){

                $this->soportesAlquilados[] = $s;
                $s->alquilado=true;
                $this->actualizarNumSoportesAlquilados();
                $this->logger->info("Alquilado soporte a: " . $this->nombre);
                $s->muestraResumen();

            }else{
                $this->logger->warning("El cliente " . $this->nombre . " ha superado el cupo de alquileres.");
                throw new CupoSuperadoException("<p>Este cliente (<strong>" . $this->nombre . "</strong>) tiene " . $this->getNumSoportesAlquilados() . " elementos alquilados. No puede alquilar más en este videoclub hasta que no devuelva algo</p>");
               
            }

        }else{
                $this->logger->warning("El cliente " . $this->nombre . " ya tiene alquilado el soporte " . $s->getTitulo());
                throw new SoporteYaAlquiladoException("<p>El cliente ya tiene alquilado el soporte <strong>" . $s->getTitulo() . "</strong></p>");
        }

        return $this;
    }

    /**
     * Comprueba si se puede devolver el soporte pasado por parametros, se comprueba que la posicion pasada no se exceda del numero de soportes alquilados
     * 
     * @param int $numSoporte Es la posicion del soporte a devolver
     * @return bool Devuelve true si el soporte se ha podido devolver, false en caso contrario
     */
    public function devolver(int $numSoporte){
        if($numSoporte < $this->numSoportesAlquilados){
                $soporteAux = $this->soportesAlquilados[$numSoporte];
                $soporteAux->alquilado = false;
                unset($this->soportesAlquilados[$numSoporte]);
                $this->soportesAlquilados = array_values($this->soportesAlquilados);
                $this->actualizarNumSoportesAlquilados();
                $this->logger->info("Se ha devuelto el soporte seleccionado (" . $soporteAux->getTitulo() . ")");
        }else{
                $this->logger->warning("No se ha podido encontrar el soporte en los alquileres de este cliente (" . $this->nombre . ")");
                throw new SoporteNoEncontradoException("<p>No se ha podido encontrar el soporte en los alquileres de este cliente(<strong>" . $this->nombre . "</strong>)</p>");       
        }

        return $this;
    }

    /**
     * Metodo que imprime por panta los soportes alquilado en caso de que el usuario tenga alquilado alguno
     */
    public function listarAlquileres(){
        if($this->numSoportesAlquilados != 0){
            $this->logger->info("El cliente(" . $this->nombre . ") tiene " . $this->numSoportesAlquilados . " soportes alquilados");
            foreach($this->soportesAlquilados as $soporte){
                
                $soporte->muestraResumen();
            }
        }else{
            $this->logger->info("Este cliente(" . $this->nombre . ") no tiene alquilado ningún elemento");
        }
    }
}

?>