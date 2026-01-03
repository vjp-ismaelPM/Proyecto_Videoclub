<?php

namespace Dwes\ProyectoVideoclub\Model;


use Dwes\ProyectoVideoclub\Model\Util\CupoSuperadoException;
use Dwes\ProyectoVideoclub\Model\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Model\Util\SoporteNoEncontradoException;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Level;




class Videoclub
{



    //CONSTRUCTOR
    public function __construct(
        private string $nombre = "",
        private array $productos = [],
        private int $numProductos = 0,
        private array $socios = [],
        private int $numSocios = 0,
        private int $numProductosAlquilados = 0,
        private int $numTotalAlquileres = 0,
    ) {
        $this->logger = new Logger('VideoclubLogger');
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/videoclub.log', Level::Debug));
    }

    private Logger $logger;

    //GETTER
    public function getNumProductosAlquilados(): int
    {
        return $this->numProductosAlquilados;
    }

    public function getNumTotalAlquileres(): int
    {
        return $this->numTotalAlquileres;
    }

    //METODOS 

    /**
     * Metodo para actualizar el numero de productos
     */
    public function actuzalizarNumProductos()
    {
        $this->numProductos = count($this->productos);
    }

    /**
     * Metodo para actualizar el numero de socios
     */
    public function actuzalizarNumSocios()
    {
        $this->numSocios = count($this->socios);
    }

    /**
     * Metodo para incluir un producto a la lista de productos
     * 
     * @param Soporte $producto Es el producto que se aniadir a la lista productos
     */
    private function incluirProducto(Soporte $producto)
    {
        $this->productos[] = $producto;
        $this->logger->info("Incluido producto " . $this->numProductos, ['numProductos' => $this->numProductos]);
        $this->actuzalizarNumProductos();
    }

    /**
     * Metodo para incluir una cinta de video en la lista de productos
     * 
     * @param string $titulo El titulo de la cinta de video
     * @param float $precio El precio de la cinta
     * @param int $duracion la duracion en minutos de la cinta 
     */
    public function incluirCintaVideo(string $titulo, float $precio, int $duracion)
    {
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
    public function incluirDvd(string $titulo, float $precio, string $idimoas, string $pantalla)
    {
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
    public function incluirJuego(string $titulo, float $precio, string $consola, int $min, int $max)
    {
        $producto = new Juego($titulo, ($this->numProductos), $precio, $consola, $min, $max);
        $this->incluirProducto($producto);
    }

    /**
     * Metodo para incluir un socio a la lista de socios
     * 
     * @param string $nombre Es el nombre del nuevo socio
     * @param int $maxAlquileresConcurrentes Es el maximo de alquileres que puede tener de forma concurrente
     */
    public function incluirSocio(string $nombre, int $maxAlquileresConcurrentes = 3)
    {
        $user = strtolower(str_replace(' ', '', $nombre));
        $password = '1234';
        $socio = new Cliente($nombre, $user, $password, $this->numSocios, [], 0, $maxAlquileresConcurrentes);
        $this->socios[] = $socio;
        $this->logger->info("Incluido socio " . $this->numSocios, ['numSocios' => $this->numSocios]);
        $this->actuzalizarNumSocios();
    }

    /**
     * Metodo para listar todos los productos
     */
    public function listarProductos()
    {
        $this->logger->info("Listado de los " . $this->numProductos . " productos disponibles", ['numProductos' => $this->numProductos]);
        foreach ($this->productos as $producto) {
            $this->logger->info("Producto " . $producto->getNumero(), ['numero' => $producto->getNumero()]);
            $producto->muestraResumen();
        }
    }

    /**
     * Metodo para listar todos los socios
     */
    public function listarSocios()
    {
        $this->logger->info("Listado de los " . $this->numSocios . " socios del videoclub", ['numSocios' => $this->numSocios]);
        foreach ($this->socios as $socio) {
            $this->logger->info("Cliente " . $socio->getNumero() . ": " . $socio->getNombre(), [
                'numero' => $socio->getNumero(),
                'nombre' => $socio->getNombre(),
                'alquileres' => $socio->getNumSoportesAlquilados()
            ]);
        }
    }

    /**
     * Metodo para que un cliente alquile un soporte
     * 
     * @param int $numCliente el numero del cliente
     * @param int $numSoporte el numero del soporte
     */
    public function alquilarSocioProducto(int $numCliente, int $numSoporte)
    {
        if ($numCliente <= $this->numSocios && $numSoporte <= $this->numProductos) {
            $socio = $this->socios[$numCliente];
            $producto = $this->productos[$numSoporte];


            try {
                $socio->alquilar($producto);
                $this->logger->info("Alquilado soporte a: " . $socio->getNombre(), [
                    'socio' => $socio->getNombre(),
                    'producto' => $producto->getTitulo()
                ]);
            } catch (SoporteYaAlquiladoException | CupoSuperadoException $e) {
                $this->logger->info($e->getMessage());
            }
        } else {
            $this->logger->info("Introduce valores correctos");
        }

        return $this;
    }

    /**
     * Metodo para que un cliente alquile varios soportes
     * 
     * @param int $numSocio El número del cliente
     * @param array $numerosProductos Array con los números de los soportes a alquilar
     */
    public function alquilarSocioProductos(int $numSocio, array $numerosProductos): void
    {
        if ($numSocio < 0 || $numSocio >= $this->numSocios) {

            $this->logger->info("Número de socio: " . $numSocio . " no encontrado", ['numSocio' => $numSocio]);
            return;
        }

        $socio = $this->socios[$numSocio];
        $todosDisponibles = true;

        for ($i = 0; $i < count($numerosProductos); $i++) {

            $numProducto = $numerosProductos[$i];

            if ($numProducto < 0 || $numProducto >= $this->numProductos) {

                $this->logger->info("Número de soporte: " . $numProducto . " no encontrado", ['numProducto' => $numProducto]);
                $todosDisponibles = false;
                break;
            }

            if ($this->productos[$numProducto]->alquilado) {

                $this->logger->info("El soporte " . $this->productos[$numProducto]->getTitulo() . " ya está alquilado", ['producto' => $this->productos[$numProducto]->getTitulo()]);
                $todosDisponibles = false;
                break;
            }
        }

        if ($todosDisponibles) {

            for ($i = 0; $i < count($numerosProductos); $i++) {

                $numProducto = $numerosProductos[$i];
                $producto = $this->productos[$numProducto];
                $socio->alquilar($producto);
                $producto->alquilado = true;
                $this->logger->info("Soporte " . $producto->getTitulo() . " alquilado a " . $socio->getNombre(), [
                    'socio' => $socio->getNombre(),
                    'producto' => $producto->getTitulo()
                ]);
            }
        }
    }

    /**
     * Metodo para que un cliente devuelva un soporte
     * 
     * @param int $numSocio El número del socio que devuelve el soporte
     * @param int $numProducto El número del soporte a devolver
     */

    public function devolverSocioProducto(int $numSocio, int $numProducto): self
    {
        if ($numSocio < 0 || $numSocio >= $this->numSocios) {

            $this->logger->info("Número de socio: " . $numSocio . " no encontrado", ['numSocio' => $numSocio]);
            return $this;
        }

        if ($numProducto < 0 || $numProducto >= $this->numProductos) {

            $this->logger->info("Número de soporte: " . $numProducto . " no encontrado", ['numProducto' => $numProducto]);
            return $this;
        }

        $socio = $this->socios[$numSocio];
        $producto = $this->productos[$numProducto];

        // Intentar devolver el soporte
        try {
            $socio->devolver($numProducto);
            $producto->alquilado = false; // marcar como no alquilado
            $this->logger->info("El soporte " . $producto->getTitulo() . " ha sido devuelto por " . $socio->getNombre(), [
                'socio' => $socio->getNombre(),
                'producto' => $producto->getTitulo()
            ]);
        } catch (SoporteNoEncontradoException $e) {
            $this->logger->info("El socio " . $socio->getNombre() . " no tenía alquilado el soporte " . $producto->getTitulo(), [
                'socio' => $socio->getNombre(),
                'producto' => $producto->getTitulo()
            ]);
        }

        return $this;
    }

    /**
     * Metodo para que un cliente devuelva varios soportes
     * 
     * @param int $numSocio El número del socio que devuelve los soportes
     * @param array $numerosProductos Array con los números de los soportes a devolver
     */
    public function devolverSocioProductos(int $numSocio, array $numerosProductos): self
    {
        if ($numSocio < 0 || $numSocio >= $this->numSocios) {

            $this->logger->info("Número de socio: " . $numSocio . " no encontrado", ['numSocio' => $numSocio]);
            return $this;
        }

        $socio = $this->socios[$numSocio];

        // Recorremos todos los productos a devolver
        for ($i = 0; $i < count($numerosProductos); $i++) {

            $numProducto = $numerosProductos[$i];

            if ($numProducto < 0 || $numProducto >= $this->numProductos) {

                $this->logger->info("Número de soporte: " . $numProducto . " no encontrado", ['numProducto' => $numProducto]);
                continue; // pasa al siguiente
            }

            $producto = $this->productos[$numProducto];

            try {
                $socio->devolver($numProducto);
                $producto->alquilado = false;
                $this->logger->info("El soporte " . $producto->getTitulo() . " devuelto por " . $socio->getNombre(), [
                    'socio' => $socio->getNombre(),
                    'producto' => $producto->getTitulo()
                ]);
            } catch (SoporteNoEncontradoException $e) {
                $this->logger->info("El socio " . $socio->getNombre() . " no tenía alquilado el soporte " . $producto->getTitulo(), [
                    'socio' => $socio->getNombre(),
                    'producto' => $producto->getTitulo()
                ]);
            }
        }

        return $this;
    }
}
