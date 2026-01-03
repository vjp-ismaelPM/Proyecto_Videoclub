<?php 
namespace Dwes\ProyectoVideoclub\Model;



abstract class Soporte implements Resumible{
    private const IVA = 0.21;
    
//CONSTRUCTOR
    public function __construct(
        private string $titulo = "",
        private int $numero = 0,
        private float $precio = 0,
        public bool $alquilado = false
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
     * Metodo que muestra un resumen de los datos del soporte, no hace falta que lo implemeten los hijos
     * ya que heredan de soporte
     */
     public function muestraResumen(){
        echo
            '<strong>' . $this->titulo . '</strong><br>' . $this->precio . ' (IVA no incluido)'
        ;
    }

}

?>