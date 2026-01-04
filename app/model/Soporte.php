<?php

namespace Dwes\ProyectoVideoclub\Model;

/**
 * Clase abstracta Soporte que representa un producto del videoclub.
 * 
 * @package Dwes\ProyectoVideoclub\Model
 */
abstract class Soporte
{
    /**
     * @var float IVA aplicado a los productos
     */
    private const IVA = 0.21;

    /**
     * Constructor de la clase Soporte.
     * 
     * @param string $titulo Título del soporte.
     * @param int $numero Número identificador único del soporte en el videoclub.
     * @param float $precio Precio base de alquiler (sin IVA).
     * @param bool $alquilado Indica si el soporte está actualmente alquilado. Por defecto es false.
     * @param string $metacritic URL de Metacritic del soporte.
     */
    public function __construct(
        private string $titulo,
        protected int $numero,
        private float $precio,
        private bool $alquilado = false,
        protected string $metacritic = ""
    ) {
    }

    /**
     * Obtiene el precio base del producto
     * @return float Precio base
     */
    public function getPrecio(): float
    {
        return $this->precio;
    }

    /**
     * Obtiene el precio del producto con IVA incluido
     * @return float Precio con IVA
     */
    public function getPrecioConIva(): float
    {
        return $this->precio * (1 + self::IVA);
    }

    /**
     * Obtiene el número identificador del producto
     * @return int Número
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * Obtiene el título del producto
     * @return string Título
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * Obtiene la URL de Metacritic del producto
     * @return string URL de Metacritic
     */
    public function getMetacritic(): string
    {
        return $this->metacritic;
    }

    /**
     * Obtiene el estado de alquiler del producto
     * @return bool True si está alquilado, false en caso contrario
     */
    public function getAlquilado(): bool
    {
        return $this->alquilado;
    }

    /**
     * Establece el estado de alquiler del producto
     * @param bool $alquilado Nuevo estado de alquiler
     * @return void
     */
    public function setAlquilado(bool $alquilado): void
    {
        $this->alquilado = $alquilado;
    }

    /**
     * Obtiene la puntuación de Metacritic del producto mediante web scraping.
     * 
     * @return int|null Puntuación de Metacritic o null si no está disponible.
     */
    abstract public function getPuntuacion(): ?int;

    /**
     * Muestra por pantalla un resumen de los datos del producto (título y precio base).
     * 
     * @return void
     */
    public function muestraResumen()
    {
        echo "<strong>" . $this->titulo . "</strong><br>";
        echo "Precio: " . $this->precio . " € (IVA no incluido)<br>";
    }
}