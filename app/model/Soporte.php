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
     */
    public function __construct(
        public string $titulo,
        protected int $numero,
        private float $precio,
        public bool $alquilado = false
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