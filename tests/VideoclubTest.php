<?php

namespace Dwes\ProyectoVideoclub\tests;

use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\Model\Videoclub;

class VideoclubTest extends TestCase
{
    private Videoclub $videoclub;

    protected function setUp(): void
    {
        $this->videoclub = new Videoclub("VideoTest");

        // Productos
        $this->videoclub->incluirCintaVideo("url1", "Titanic", 15.5, 180);
        $this->videoclub->incluirDvd("url2", "Matrix", 19.99, "ES/EN", "16:9");
        $this->videoclub->incluirJuego("url3", "FIFA", 49.99, "PS5", 1, 4);

        // Socios
        $this->videoclub->incluirSocio("Juan", 3);
        $this->videoclub->incluirSocio("Ana", 1);
    }

    public function testAlquilarProductoASocio(): void
    {
        $this->videoclub->alquilarSocioProducto(0, 0);

        $socio = $this->videoclub->getSocios()[0];

        $this->assertCount(1, $socio->getAlquileres());
    }

    public function testAlquilarVariosProductosASocio(): void
    {
        $this->videoclub->alquilarSocioProductos(0, [0, 1]);

        $socio = $this->videoclub->getSocios()[0];

        $this->assertCount(2, $socio->getAlquileres());
    }

    public function testNoAlquilaSiSuperaCupo(): void
    {
        // Ana solo puede alquilar 1
        $this->videoclub->alquilarSocioProducto(1, 0);
        $this->videoclub->alquilarSocioProducto(1, 1);

        $socio = $this->videoclub->getSocios()[1];

        $this->assertCount(1, $socio->getAlquileres());
    }

    public function testDevolverProducto(): void
    {
        $this->videoclub->alquilarSocioProducto(0, 0);
        $this->videoclub->devolverSocioProducto(0, 0);

        $socio = $this->videoclub->getSocios()[0];

        $this->assertCount(0, $socio->getAlquileres());
    }

    public function testDevolverVariosProductos(): void
    {
        $this->videoclub->alquilarSocioProductos(0, [0, 1]);
        $this->videoclub->devolverSocioProductos(0, [0, 1]);

        $socio = $this->videoclub->getSocios()[0];

        $this->assertCount(0, $socio->getAlquileres());
    }

    public function testIndicesInvalidosNoRompen(): void
    {
        // No debe lanzar errores
        $this->videoclub->alquilarSocioProducto(99, 99);
        $this->videoclub->devolverSocioProducto(99, 99);

        $this->assertTrue(true);
    }
}
