<?php

namespace Dwes\ProyectoVideoclub;
include_once(__DIR__ . '/../autoload.php');


class Videoclub{

    

//CONSTRUCTOR
    public function __construct(
        private string $nombre = "",
        private array $productos = [],
        private int $numProductos = 0,
        private array $socios = [],
        private int $numSocios = 0,
    ){}
         
//METODOS 

    /**
     * Metodo para actualizar el numero de productos
     */
    public function actuzalizarNumProductos(){
        $this->numProductos = count($this->productos);
    }

    /**
     * Metodo para actualizar el numero de socios
     */
    public function actuzalizarNumSocios(){
        $this->numSocios = count($this->socios);
    }

    /**
     * Metodo para incluir un producto a la lista de productos
     * 
     * @param Soporte $producto Es el producto que se aniadir a la lista productos
     */
    private function incluirProducto(Soporte $producto){
        $this->productos[] = $producto;
        echo "<p>Inculido producto " . $this->numProductos . "</p>";
        $this->actuzalizarNumProductos();
    }

    /**
     * Metodo para incluir una cinta de video en la lista de productos
     * 
     * @param string $titulo El titulo de la cinta de video
     * @param float $precio El precio de la cinta
     * @param int $duracion la duracion en minutos de la cinta 
     */
    public function incluirCintaVideo(string $titulo, float $precio, int $duracion){
        $producto = new CintaVideo($titulo, ($this->numProductos), $precio, $duracion);
        $this->incluirProducto($producto);
    }

    /**
     * Metodo para incluir un DVD en la lista de productos
     * 
     * @param string $titulo El titulo del DVD
     * @param float $precio El precio del DVD
     * @param string $idiomas Los idiomas en los que esta el DVD
     * @param string $pantalla La resolucion en pantalla del DVD
     */
    public function incluirDvd(string $titulo, float $precio, string $idimoas, string $pantalla){
        $producto = new Dvd($titulo, ($this->numProductos), $precio, $idimoas, $pantalla);
        $this->incluirProducto($producto);
    }

    /**
     * Metodo para incluir un juego en la lista de productos
     * 
     * @param string $titulo El titulo del juego
     * @param float $precio El precio del juego
     * @param string $consola El nombre de la consola con la que se puede jugar al juego
     * @param int $min El minimo de jugadores
     * @param int $max El maximo de jugadores
     */
    public function incluirJuego(string $titulo, float $precio, string $consola, int $min, int $max){
        $producto = new Juego($titulo, ($this->numProductos), $precio, $consola, $min, $max);
        $this->incluirProducto($producto);
    }

    /**
     * Metodo para incluir un socio a la lista de socios
     * 
     * @param string $nombre Es el nombre del nuevo socio
     * @param int $maxAlquileresConcurrentes Es el maximo de alquileres que puede tener de forma concurrente
     */
    public function incluirSocio(string $nombre, int $maxAlquileresConcurrentes = 3){
        $socio = new Cliente($nombre,($this->numSocios),[],0,$maxAlquileresConcurrentes);
        $this->socios[] = $socio;
        echo "<p>Inculido socio " . $this->numSocios . "</p>";
        $this->actuzalizarNumSocios();
    }

    /**
     * Metodo para listar todos los productos
     */
    public function listarProductos(){
        echo "<p>Listado de los " . $this->numProductos . " productos disponibles:</p>";
        foreach($this->productos as $producto){
            echo "<p>" . $producto->getNumero() . ".- ";
            echo $producto->muestraResumen() . "</p>";
        }
    }

    /**
     * Metodo para listar todos los socios
     */
    public function listarSocios(){
        echo "<p>Listado de los " . $this->numSocios . " socios del videoclub:<br>";
        foreach($this->socios as $socio){
            echo ($socio->getNumero() + 1) . ".- <strong>Cliente</strong> " . $socio->getNumero() . ": " . $socio->getNombre() . "<br>".
            "Alquileres actuales: " . $socio->getNumSoportesAlquilados() . "</br>";
        }
        echo"</p>";
    }

    public function alquilarSocioProducto(int $numCliente, int $numSoporte){
        if($numCliente <= $this->numSocios && $numSoporte <= $this->numProductos){
            $socio = $this->socios[$numCliente];
            $producto = $this->productos[$numSoporte];
            if($socio->alquilar($producto)){
                echo "***  Alquilado soporte a: " . $socio->getNombre() . "***</p>";
            }
        }else{
            echo "Introduce valores correctos";
        }

        return $this;

    }

}

?>