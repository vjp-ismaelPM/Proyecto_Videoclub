<?php

namespace Dwes\ProyectoVideoclub;

require_once __DIR__ . '/../vendor/autoload.php';

use Dwes\ProyectoVideoclub\Model\Videoclub;
use Dwes\ProyectoVideoclub\Util\MetacriticScraper;

echo "<h1>Videoclub - Prueba con Metacritic</h1>";

// Crear instancia del videoclub
$vc = new Videoclub("Severo 8A");

echo "<h2>Incluyendo productos con URLs de Metacritic</h2>";

// Incluir juegos con URLs de Metacritic
$vc->incluirJuego(
    "https://www.metacritic.com/game/god-of-war-2018/",
    "God of War",
    19.99,
    "PS4",
    1,
    1
);

$vc->incluirJuego(
    "https://www.metacritic.com/game/the-last-of-us-part-ii/",
    "The Last of Us Part II",
    49.99,
    "PS4",
    1,
    1
);

// Incluir DVDs con URLs de Metacritic
$vc->incluirDvd(
    "https://www.metacritic.com/movie/inception/",
    "Origen",
    4.5,
    "es,en,fr",
    "16:9"
);

$vc->incluirDvd(
    "https://www.metacritic.com/movie/the-empire-strikes-back/",
    "El Imperio Contraataca",
    3,
    "es,en",
    "16:9"
);

// Incluir Cintas de Video con URLs de Metacritic
$vc->incluirCintaVideo(
    "https://www.metacritic.com/movie/ghostbusters/",
    "Los cazafantasmas",
    3.5,
    107
);

$vc->incluirCintaVideo(
    "https://www.metacritic.com/movie/the-name-of-the-rose/",
    "El nombre de la Rosa",
    1.5,
    140
);

echo "<h2>Listado de Productos</h2>";
$vc->listarProductos();

echo "<hr>";
echo "<h2>Información de Metacritic (Web Scraping)</h2>";

// Probar web scraping con algunos productos
echo "<h3>God of War</h3>";
$godOfWarData = MetacriticScraper::getMetacriticData("https://www.metacritic.com/game/god-of-war-2018/");
echo "<p><strong>Metascore:</strong> " . ($godOfWarData['metascore'] ?? 'No disponible') . "</p>";
echo "<p><strong>User Score:</strong> " . ($godOfWarData['userscore'] ?? 'No disponible') . "</p>";
echo "<p><strong>Resumen:</strong> " . ($godOfWarData['summary'] ?: 'No disponible') . "</p>";

echo "<h3>Los Cazafantasmas (Ghostbusters)</h3>";
$ghostbustersData = MetacriticScraper::getMetacriticData("https://www.metacritic.com/movie/ghostbusters/");
echo "<p><strong>Metascore:</strong> " . ($ghostbustersData['metascore'] ?? 'No disponible') . "</p>";
echo "<p><strong>User Score:</strong> " . ($ghostbustersData['userscore'] ?? 'No disponible') . "</p>";
echo "<p><strong>Resumen:</strong> " . ($ghostbustersData['summary'] ?: 'No disponible') . "</p>";

echo "<h3>The Last of Us Part II</h3>";
$tlouData = MetacriticScraper::getMetacriticData("https://www.metacritic.com/game/the-last-of-us-part-ii/");
echo "<p><strong>Metascore:</strong> " . ($tlouData['metascore'] ?? 'No disponible') . "</p>";
echo "<p><strong>User Score:</strong> " . ($tlouData['userscore'] ?? 'No disponible') . "</p>";
echo "<p><strong>Resumen:</strong> " . ($tlouData['summary'] ?: 'No disponible') . "</p>";

echo "<hr>";
echo "<h2>Creando Socios</h2>";
$vc->incluirSocio("Amancio Ortega");
$vc->incluirSocio("Pablo Picasso", 2);

echo "<h2>Alquilando Productos</h2>";
$vc->alquilarSocioProducto(0, 0); // Amancio alquila God of War
$vc->alquilarSocioProducto(0, 2); // Amancio alquila Origen

echo "<h2>Listado de Socios</h2>";
$vc->listarSocios();

?>
