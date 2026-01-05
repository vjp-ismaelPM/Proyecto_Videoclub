<?php
use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\model\Dvd;

class DvdTest extends TestCase {
    
    public function testMuestraResumenDevuelveCadena(): void {
        $dvd = new Dvd("Inception", 3, 22.99, "Inglés, Español", "16:9");
        $resultado = $dvd->muestraResumen();
        
        $this->assertIsString($resultado);
        $this->assertStringContainsString("Película en DVD", $resultado);
        $this->assertStringContainsString("Inception", $resultado);
        $this->assertStringContainsString("Inglés, Español", $resultado);
        $this->assertStringContainsString("16:9", $resultado);
    }
}