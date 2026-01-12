<?php
use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\model\Soporte;

class SoporteTest extends TestCase {
    
    public function testMuestraResumenDevuelveCadena(): void {
        // Crea una clase anónima que extiende Soporte
        $soporte = new class("Matrix", 1, 19.99) extends Soporte {
            // Implementa el método abstracto getPuntuacion
            public function getPuntuacion(): int {
                return 5; // Valor de prueba
            }
        };
        
        $resultado = $soporte->muestraResumen();
        
        $this->assertIsString($resultado);
        $this->assertStringContainsString("Matrix", $resultado);
        $this->assertStringContainsString("19.99", $resultado);
        $this->assertStringContainsString("Precio:", $resultado);
    }
}