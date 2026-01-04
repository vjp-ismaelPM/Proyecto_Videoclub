<?php 

namespace Dwes\ProyectoVideoclub\Model;


use Dwes\ProyectoVideoclub\Model\Util\CupoSuperadoException;
use Dwes\ProyectoVideoclub\Model\Util\SoporteNoEncontradoException;
use Dwes\ProyectoVideoclub\Model\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\LogFactory;
use Psr\Log\LoggerInterface;

/**
 * Clase que representa un cliente del videoclub.
 * 
 * @package Dwes\ProyectoVideoclub\Model
 */
class Cliente{
        
    private LoggerInterface $logger;

    /**
     * Constructor de la clase Cliente.
     * 
     * @param string $nombre Nombre del cliente.
     * @param string $usuario Nombre de usuario.
     * @param string $password Contraseña del usuario.
     * @param int $numero Número de socio.
     * @param array $soportesAlquilados Lista de soportes alquilados.
     * @param int $numSoportesAlquilados Número de soportes alquilados actualmente.
     * @param int $maxAlquilerConcurrente Máximo de alquileres permitidos simultáneamente.
     */
    public function __construct(
        private string $nombre = "",
        private string $usuario = "",      
        private string $password = "", 
        private int $numero = 0,
        private array $soportesAlquilados = [],
        private int $numSoportesAlquilados = 0,
        private int $maxAlquilerConcurrente = 3,
    ){
        $this->logger = LogFactory::getLogger();
    }

    /**
     * Obtiene el nombre del cliente.
     * 
     * @return string Nombre del cliente.
     */
    public function getNombre():string{
        return $this->nombre;
    }

    /**
     * Obtiene el nombre de usuario.
     * 
     * @return string Nombre de usuario.
     */
    public function getUsuario():string{
        return $this->usuario;
    }

    /**
     * Obtiene la contraseña del usuario.
     * 
     * @return string Contraseña del usuario.
     */
    public function getPassword():string{
        return $this->password;
    }

    /**
     * Obtiene el número de socio.
     * 
     * @return int Número de socio.
     */
    public function getNumero():int{
        return $this->numero;
    }

    /**
     * Obtiene la lista de soportes alquilados.
     * 
     * @return array Lista de soportes alquilados.
     */
    public function getSoportesAlquilados(){
        return $this->soportesAlquilados;
    }

    /**
     * Obtiene el número de soportes alquilados actualmente.
     * 
     * @return int Número de soportes alquilados.
     */
    public function getNumSoportesAlquilados(){
        return $this->numSoportesAlquilados;
    } 

    /**
     * Establece el número de socio.
     * 
     * @param int $numero Nuevo número de socio.
     */
    public function setNumero(int $numero){
        $this->numero = $numero;
    }

    /**
     * Actualiza el contador interno de soportes alquilados.
     * 
     * @return void
     */
    public function actualizarNumSoportesAlquilados(){
        $this->numSoportesAlquilados = count($this->soportesAlquilados);
    }

    /**
     * Muestra por pantalla un resumen de los datos del cliente y sus alquileres.
     * 
     * @return void
     */
    public function muestraResumen (){
        echo "<p>El nombre del cliente es: " . $this->nombre . " y ha alquilado " . count($this->soportesAlquilados) . " soportes</p>";
    }

    /**
     * Comprueba si un cliente tiene alquilado un soporte específico.
     *
     * @param Soporte $soporte Soporte a comprobar.
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
     * Alquila un soporte al cliente si tiene cupo disponible y no lo tiene ya alquilado.
     * 
     * @param Soporte $s Soporte a alquilar.
     * @throws CupoSuperadoException Si el cliente ha superado el máximo de alquileres permitidos.
     * @throws SoporteYaAlquiladoException Si el cliente ya tiene este soporte alquilado.
     * @return self
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
     * Devuelve un soporte alquilado por su posición en la lista.
     * 
     * @param int $numSoporte Índice del soporte a devolver en la lista de alquileres del cliente.
     * @throws SoporteNoEncontradoException Si el índice no corresponde a ningún soporte alquilado.
     * @return self
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
     * Lista por pantalla todos los soportes que el cliente tiene alquilados actualmente.
     * 
     * @return void
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