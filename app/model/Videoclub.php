<?php

namespace Dwes\ProyectoVideoclub\Model;


use Dwes\ProyectoVideoclub\Model\Util\CupoSuperadoException;
use Dwes\ProyectoVideoclub\Model\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Model\Util\SoporteNoEncontradoException;
use Dwes\ProyectoVideoclub\Util\LogFactory;
use Psr\Log\LoggerInterface;




/**
 * Clase que representa el videoclub.
 * 
 * @package Dwes\ProyectoVideoclub\Model
 */
class Videoclub
{



    //CONSTRUCTOR
    /**
     * Constructor de la clase Videoclub.
     * 
     * @param string $nombre Nombre del videoclub.
     * @param array $productos Lista de productos disponibles.
     * @param int $numProductos Número total de productos.
     * @param array $socios Lista de socios registrados.
     * @param int $numSocios Número total de socios.
     * @param int $numProductosAlquilados Número de productos actualmente alquilados.
     * @param int $numTotalAlquileres Histórico total de alquileres.
     */
    public function __construct(
        private string $nombre = "",
        private array $productos = [],
        private int $numProductos = 0,
        private array $socios = [],
        private int $numSocios = 0,
        private int $numProductosAlquilados = 0,
        private int $numTotalAlquileres = 0,
    ) {
        $this->logger = LogFactory::getLogger();
    }

    private LoggerInterface $logger;

    //GETTER
    /**
     * Obtiene el número de productos alquilados actualmente.
     * 
     * @return int Número de productos alquilados.
     */
    public function getNumProductosAlquilados(): int
    {
        return $this->numProductosAlquilados;
    }

    /**
     * Obtiene el número total de alquileres realizados.
     * 
     * @return int Número total de alquileres.
     */
    public function getNumTotalAlquileres(): int
    {
        return $this->numTotalAlquileres;
    }

    //METODOS 

    /**
     * Actualiza el contador interno de productos.
     * 
     * @return void
     */
    public function actuzalizarNumProductos()
    {
        $this->numProductos = count($this->productos);
    }

    /**
     * Actualiza el contador interno de socios.
     * 
     * @return void
     */
    public function actuzalizarNumSocios()
    {
        $this->numSocios = count($this->socios);
    }

    /**
     * Incluye un producto de forma interna en la lista de productos del videoclub.
     * 
     * @param Soporte $producto Producto a añadir.
     * @return void
     */
    private function incluirProducto(Soporte $producto)
    {
        $this->productos[] = $producto;
        $this->logger->info("Incluido producto " . $this->numProductos, ['numProductos' => $this->numProductos]);
        $this->actuzalizarNumProductos();
    }

    /**
     * Crea e incluye una nueva cinta de video en el catálogo.
     * 
     * @param string $titulo Título de la película.
     * @param float $precio Precio de alquiler.
     * @param int $duracion Duración en minutos.
     * @return void
     */
    public function incluirCintaVideo(string $titulo, float $precio, int $duracion)
    {
        $producto = new CintaVideo($titulo, ($this->numProductos), $precio, $duracion);
        $this->incluirProducto($producto);
    }

    /**
     * Crea e incluye un nuevo DVD en el catálogo.
     * 
     * @param string $titulo Título de la película.
     * @param float $precio Precio de alquiler.
     * @param string $idimoas Idiomas disponibles.
     * @param string $pantalla Formato de pantalla.
     * @return void
     */
    public function incluirDvd(string $titulo, float $precio, string $idimoas, string $pantalla)
    {
        $producto = new Dvd($titulo, ($this->numProductos), $precio, $idimoas, $pantalla);
        $this->incluirProducto($producto);
    }

    /**
     * Crea e incluye un nuevo juego en el catálogo.
     * 
     * @param string $titulo Título del videojuego.
     * @param float $precio Precio de alquiler.
     * @param string $consola Consola compatible.
     * @param int $min Número mínimo de jugadores.
     * @param int $max Número máximo de jugadores.
     * @return void
     */
    public function incluirJuego(string $titulo, float $precio, string $consola, int $min, int $max)
    {
        $producto = new Juego($titulo, ($this->numProductos), $precio, $consola, $min, $max);
        $this->incluirProducto($producto);
    }

    /**
     * Incluye un nuevo socio en el videoclub.
     * 
     * @param string $nombre Nombre del nuevo socio.
     * @param int $maxAlquileresConcurrentes Máximo de alquileres permitidos para este socio.
     * @return void
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
     * Lista por pantalla todos los productos disponibles en el videoclub.
     * 
     * @return void
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
     * Lista por pantalla todos los socios registrados en el videoclub.
     * 
     * @return void
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
     * Alquila un producto a un socio.
     * 
     * @param int $numCliente Número del socio.
     * @param int $numSoporte Número del producto.
     * @return self
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
     * Alquila varios productos a un socio.
     * 
     * @param int $numSocio Número del socio.
     * @param array $numerosProductos Array con los números de los productos a alquilar.
     * @return void
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
     * Devuelve un producto alquilado por un socio.
     * 
     * @param int $numSocio Número del socio.
     * @param int $numProducto Número del producto.
     * @return self
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
     * Devuelve varios productos alquilados por un socio.
     * 
     * @param int $numSocio Número del socio.
     * @param array $numerosProductos Array con los números de los productos a devolver.
     * @return self
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
