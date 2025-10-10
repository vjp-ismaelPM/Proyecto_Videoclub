<?php 
class Soporte{
    private const IVA = 0.21;
    
//CONSTRUCTOR
    public function __construct(
        private string $titulo = "",
        private int $numero = 0,
        private float $precio = 0,
    ) {}

//GETTERS
    public function getTitulo(){
        return $this->titulo;
    }
    
    public function getNumero(){
        return $this->numero;
    }
   
    public function getPrecio(){
        return $this->precio;
    }

//METODOS

    /**
     * Metodo que devuelve el precio con el IVA incluido
     */
    public function getPrecioConIva(){
        return $this->precio * (1 + self::IVA);
    }

    /**
     * Metodo que muestra un resumen de los datos del soporte
     */
    public function muestraResumen(){
        echo
            '<br>' . $this->titulo . '<br>' . $this->precio . ' (IVA no incluido)'
        ;
    }

}

?>