<?php
use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\model\Dvd;

class DvdTest extends TestCase {
    
    public function testMuestraResumenDevuelveCadena(): void {
        // Título, Número, Precio, Duración, Idiomas, FormatoPantalla
        $dvd = new Dvd("Inception", 3, 22.99, 148, "Inglés, Español", "16:9");
        $resultado = $dvd->muestraResumen();
        
        $this->assertIsString($resultado);
        $this->assertStringContainsString("Película en DVD", $resultado);
        $this->assertStringContainsString("Inception", $resultado);
        $this->assertStringContainsString("Inglés, Español", $resultado);
        $this->assertStringContainsString("16:9", $resultado);
        $this->assertStringContainsString("Duración: 148 minutos", $resultado);
    }

    public function testAccesorDuracion(): void {
        $dvd = new Dvd("Inception", 3, 22.99, 148, "Inglés, Español", "16:9");
        $this->assertEquals(148, $dvd->getDuracion());
    }
}