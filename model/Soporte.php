<?php 

class Soporte
{
    public function __construct(
        private string $titulo = "",
        private int $numero = 0,
        private int $precio = 0,
    ) {}

    public function getTitulo()
    {
        return $this->titulo;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getNumero()
    {
        return $this->numero;
    }
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    public function __toString()
    {
        return "Soporte: " . $this->titulo . " - Número: " . $this->numero . " - Precio: " . $this->precio . " €";
    }

}




?>