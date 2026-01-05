<?php
use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\model\Juego;

class JuegoTest extends TestCase {
    
    public function testMuestraResumenDevuelveCadena(): void {
        $juego = new Juego("The Last of Us", 4, 49.99, "PS4", 1, 4);
        $resultado = $juego->muestraResumen();
        
        $this->assertIsString($resultado);
        $this->assertStringContainsString("Juego para:PS4", $resultado);
        $this->assertStringContainsString("The Last of Us", $resultado);
        $this->assertStringContainsString("49.99", $resultado);
    }
}