<?php
namespace Dwes\ProyectoVideoclub\tests;

use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\Model\Videoclub;
use Dwes\Videoclub\Exception\ClienteNoExisteException;

class VideoclubTest extends TestCase
{
    private Videoclub $videoclub;

    protected function setUp(): void
    {
        $this->videoclub = new Videoclub();
    }

    /**
     * @test
     * Verifica que al intentar alquilar un cliente que no existe se lanza ClienteNoExisteException
     */
    public function testAlquilarClienteNoExisteLanzaExcepcion(): void
    {
        // No se ha incluido ningún socio, el índice 0 no existe
        $this->expectException(ClienteNoExisteException::class);

        $this->videoclub->alquilarSocioProducto(0, 0);
    }

    /**
     * @test
     * Verifica que al intentar devolver un cliente que no existe se lanza ClienteNoExisteException
     */
    public function testDevolverClienteNoExisteLanzaExcepcion(): void
    {
        // No se ha incluido ningún socio, el índice 0 no existe
        $this->expectException(ClienteNoExisteException::class);

        $this->videoclub->devolverSocioProducto(0, 0);
    }

    /**
     * @test
     * Caso positivo: incluir socio y alquilar un producto correctamente
     */
    public function testAlquilarClienteExistente(): void
    {
        $this->videoclub->incluirSocio("Juan");
        $this->videoclub->incluirCintaVideo("http://metacritic.com/titulo", "Titanic", 15.5, 180);

        // Alquilar correctamente, no debería lanzar excepción
        $this->videoclub->alquilarSocioProducto(0, 0);

        $socios = $this->videoclub->getSocios();
        $this->assertEquals(1, $socios[0]->getNumSoportesAlquilados());
    }

    /**
     * @test
     * Caso positivo: devolver un producto alquilado correctamente
     */
    public function testDevolverClienteExistente(): void
    {
        $this->videoclub->incluirSocio("Juan");
        $this->videoclub->incluirCintaVideo("http://metacritic.com/titulo", "Titanic", 15.5, 180);

        // Alquilar y luego devolver
        $this->videoclub->alquilarSocioProducto(0, 0);
        $this->videoclub->devolverSocioProducto(0, 0);

        $socios = $this->videoclub->getSocios();
        $this->assertEquals(0, $socios[0]->getNumSoportesAlquilados());
    }
}
