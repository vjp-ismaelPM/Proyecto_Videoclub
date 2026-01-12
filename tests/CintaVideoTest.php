<?php
use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\model\CintaVideo;

class CintaVideoTest extends TestCase {
    
    public function testMuestraResumenDevuelveCadena(): void {
        $cinta = new CintaVideo("Titanic", 1, 15.50, 180);
        $resultado = $cinta->muestraResumen();
        
        $this->assertIsString($resultado);
        $this->assertStringContainsString("Película en VHS", $resultado);
        $this->assertStringContainsString("Titanic", $resultado);
        $this->assertStringContainsString("180", $resultado);
        $this->assertStringContainsString("Duración:", $resultado);
    }
}