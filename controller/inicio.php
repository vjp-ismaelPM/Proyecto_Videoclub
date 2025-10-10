<?php

//Prueba soporte
    // include "../model/Soporte.php";

    // $soporte1 = new Soporte("Tenet", 22, 3); 
    // echo "<strong>" . $soporte1->getTitulo() . "</strong>"; 
    // echo "<br>Precio: " . $soporte1->getPrecio() . " euros"; 
    // echo "<br>Precio IVA incluido: " . $soporte1->getPrecioConIVA() . " euros";
    // $soporte1->muestraResumen();


//Prueba cinta video
    include "../model/CintaVideo.php";

    $miCinta = new CintaVideo("Los cazafantasmas", 23, 3.5, 107); 
    echo "<strong>" . $miCinta->getTitulo() . "</strong>"; 
    echo "<br>Precio: " . $miCinta->getPrecio() . " euros"; 
    echo "<br>Precio IVA incluido: " . $miCinta->getPrecioConIva() . " euros";
    $miCinta->muestraResumen();
?>