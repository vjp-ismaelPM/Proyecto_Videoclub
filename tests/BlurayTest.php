<?php

use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\Model\Bluray;

class BlurayTest extends TestCase {
    
    public function testConstructorYGetters(): void {
        // Título, Número, Precio, Duración, es4k, Metacritic
        $bluray = new Bluray("Avatar", 1, 25.0, 162, true, "http://metacritic.com/avatar");
        
        $this->assertEquals("Avatar", $bluray->getTitulo());
        $this->assertEquals(25.0, $bluray->getPrecio());
        $this->assertEquals(162, $bluray->getDuracion());
        $this->assertTrue($bluray->is4k());
    }

    public function testMuestraResumen4k(): void {
        $bluray = new Bluray("Avatar", 1, 25.0, 162, true);
        $resumen = $bluray->muestraResumen();
        
        $this->assertStringContainsString("Película en Bluray", $resumen);
        $this->assertStringContainsString("Avatar", $resumen);
        $this->assertStringContainsString("162 minutos", $resumen);
        $this->assertStringContainsString("Resolución: 4K", $resumen);
    }

    public function testMuestraResumenNo4k(): void {
        $bluray = new Bluray("Avatar", 1, 25.0, 162, false);
        $resumen = $bluray->muestraResumen();
        
        $this->assertStringContainsString("Resolución: HD", $resumen); // Asumimos HD si no es 4K
    }

    public function testGetPuntuacionDevuelveNullSinUrl(): void {
        $bluray = new Bluray("Avatar", 1, 25.0, 162, true);
        $this->assertNull($bluray->getPuntuacion());
    }
}
