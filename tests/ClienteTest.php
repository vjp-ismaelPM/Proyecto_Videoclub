<?php

namespace Dwes\ProyectoVideoclub\tests;

use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\Model\Cliente;
use Dwes\ProyectoVideoclub\Model\Soporte;
use Dwes\ProyectoVideoclub\Model\Util\CupoSuperadoException;
use Dwes\ProyectoVideoclub\Model\Util\SoporteYaAlquiladoException;

class ClienteTest extends TestCase
{
    /**
     * @dataProvider proveedorAlquilerCorrecto
     */
    public function testAlquilerFuncionaConDistintosCupos(
        int $cupo,
        array $soportes
    ) {
        $cliente = new Cliente("Cliente", "user", "pass", 1, [], 0, $cupo);

        foreach ($soportes as $soporte) {
            $cliente->alquilar($soporte);
        }

        $this->assertEquals(count($soportes), $cliente->getNumSoportesAlquilados());
    }

    public static function proveedorAlquilerCorrecto(): array
    {
        return [
            "Cupo 1" => [
                1,
                [new Soporte(1, "Soporte 1", 1)]
            ],
            "Cupo 2" => [
                2,
                [
                    new Soporte(1, "Soporte 1", 1),
                    new Soporte(2, "Soporte 2", 1)
                ]
            ],
            "Cupo 3" => [
                3,
                [
                    new Soporte(1, "S1", 1),
                    new Soporte(2, "S2", 1),
                    new Soporte(3, "S3", 1)
                ]
            ],
        ];
    }

    /**
     * @dataProvider proveedorSuperaCupo
     */
    public function testSuperarCupoLanzaExcepcion(
        int $cupo,
        array $soportes
    ) {
        $cliente = new Cliente("Cliente", "user", "pass", 2, [], 0, $cupo);

        $this->expectException(CupoSuperadoException::class);

        foreach ($soportes as $soporte) {
            $cliente->alquilar($soporte);
        }
    }

    public static function proveedorSuperaCupo(): array
    {
        return [
            "Cupo 1 superado" => [
                1,
                [
                    new Soporte(1, "S1", 1),
                    new Soporte(2, "S2", 1),
                ]
            ],
            "Cupo 2 superado" => [
                2,
                [
                    new Soporte(1, "S1", 1),
                    new Soporte(2, "S2", 1),
                    new Soporte(3, "S3", 1),
                ]
            ],
        ];
    }

    public function testNoSePuedeAlquilarUnSoporteYaAlquilado()
    {
        $cliente = new Cliente("Ana", "ana", "pass", 3);
        $soporte = new Soporte(1, "Matrix", 4.5);

        $cliente->alquilar($soporte);

        $this->expectException(SoporteYaAlquiladoException::class);
        $cliente->alquilar($soporte);
    }

    public function testSoportesConIdsDistintosSeAlquilanCorrectamente()
    {
        $cliente = new Cliente("Luis", "luis", "pass", 4);

        $soporte1 = new Soporte(1, "Matrix", 4);
        $soporte2 = new Soporte(2, "Matrix Reloaded", 5);

        $cliente->alquilar($soporte1);
        $cliente->alquilar($soporte2);

        $this->assertEquals(2, $cliente->getNumSoportesAlquilados());
        $this->assertTrue($cliente->tieneAlquilado($soporte1));
        $this->assertTrue($cliente->tieneAlquilado($soporte2));
    }

    public function testSoportesConMismoTituloPeroDistintoIdNoColisionan()
    {
        $cliente = new Cliente("Pepe", "pepe", "pass", 5);

        $soporte1 = new Soporte(1, "Mismo titulo", 3);
        $soporte2 = new Soporte(2, "Mismo titulo", 4);

        $cliente->alquilar($soporte1);

        $this->expectException(SoporteYaAlquiladoException::class);
        $cliente->alquilar($soporte2);
    }
}
