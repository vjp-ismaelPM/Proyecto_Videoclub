<?php 

class Soporte
{
    const IVA = 0.21;
    
    public function __construct(
        private string $titulo = "",
        private int $numero = 0,
        private int $precio = 0,
    ) {}

    public function getTitulo()
    {
        return $this->titulo;
    }
    
    public function getNumero()
    {
        return $this->numero;
    }
   
    public function getPrecio()
    {
        return $this->precio;
    }
    
    public function __toString()
    {
        return "Soporte: " . $this->titulo . " - Número: " . $this->numero . " - Precio: " . $this->precio . " €";
    }

}




?>