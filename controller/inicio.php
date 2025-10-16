<?php

//Prueba soporte
    // include "../model/Soporte.php";

    // $soporte1 = new Soporte("Tenet", 22, 3); 
    // echo "<strong>" . $soporte1->getTitulo() . "</strong>"; 
    // echo "<br>Precio: " . $soporte1->getPrecio() . " euros"; 
    // echo "<br>Precio IVA incluido: " . $soporte1->getPrecioConIVA() . " euros";
    // $soporte1->muestraResumen();


//Prueba cinta video
    // include "../model/CintaVideo.php";

    // $miCinta = new CintaVideo("Los cazafantasmas", 23, 3.5, 107); 
    // echo "<strong>" . $miCinta->getTitulo() . "</strong>"; 
    // echo "<br>Precio: " . $miCinta->getPrecio() . " euros"; 
    // echo "<br>Precio IVA incluido: " . $miCinta->getPrecioConIva() . " euros";
    // $miCinta->muestraResumen();


//Prueba Dvd
    // include "../model/Dvd.php";

    // $miDvd = new Dvd("Origen", 24, 15, "es,en,fr", "16:9"); 
    // echo "<strong>" . $miDvd->getTitulo() . "</strong>"; 
    // echo "<br>Precio: " . $miDvd->getPrecio() . " euros"; 
    // echo "<br>Precio IVA incluido: " . $miDvd->getPrecioConIva() . " euros";
    // $miDvd->muestraResumen();


//Prueba Juegos
    // include ("../model/Juego.php");

    // $miJuego = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 3, 3); 
    // echo "<strong>" . $miJuego->getTitulo() . "</strong>"; 
    // echo "<br>Precio: " . $miJuego->getPrecio() . " euros"; 
    // echo "<br>Precio IVA incluido: " . $miJuego->getPrecioConIva() . " euros";
    // $miJuego->muestraResumen();

//Prueba Cliente ejercicio 324
    include_once "../model/Cliente.php";

    $cliente1 = new Cliente("Bruce Wayne", 23);
    $cliente1->muestraResumen();
?>