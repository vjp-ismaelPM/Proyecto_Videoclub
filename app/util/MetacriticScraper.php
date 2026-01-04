<?php

namespace Dwes\ProyectoVideoclub\Util;

/**
 * Clase para realizar web scraping de Metacritic y obtener información de productos.
 * 
 * @package Dwes\ProyectoVideoclub\Util
 */
class MetacriticScraper
{
    /**
     * Obtiene todos los datos disponibles de una URL de Metacritic.
     * 
     * @param string $url URL de Metacritic del producto.
     * @return array Array asociativo con los datos scrapeados (metascore, userscore, summary).
     */
    public static function getMetacriticData(string $url): array
    {
        if (empty($url)) {
            return [
                'metascore' => null,
                'userscore' => null,
                'summary' => ''
            ];
        }

        // Configurar contexto para simular navegador
        $options = [
            'http' => [
                'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\r\n"
            ]
        ];
        $context = stream_context_create($options);

        // Intentar obtener el contenido
        $html = @file_get_contents($url, false, $context);
        
        if ($html === false) {
            return [
                'metascore' => null,
                'userscore' => null,
                'summary' => ''
            ];
        }

        // Crear DOMDocument para parsear HTML
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);

        $data = [
            'metascore' => self::extractMetascore($xpath),
            'userscore' => self::extractUserscore($xpath),
            'summary' => self::extractSummary($xpath)
        ];

        return $data;
    }

    /**
     * Extrae solo la puntuación de Metacritic de una URL.
     * 
     * @param string $url URL de Metacritic del producto.
     * @return int|null Puntuación de Metacritic o null si no se encuentra.
     */
    public static function getMetascore(string $url): ?int
    {
        $data = self::getMetacriticData($url);
        return $data['metascore'];
    }

    /**
     * Extrae el Metascore del XPath.
     * 
     * @param \DOMXPath $xpath Objeto XPath del DOM.
     * @return int|null Metascore o null.
     */
    private static function extractMetascore(\DOMXPath $xpath): ?int
    {
        // Buscar diferentes selectores comunes para Metascore
        $selectors = [
            "//div[contains(@class, 'c-siteReviewScore')]//span",
            "//div[contains(@class, 'metascore_w')]",
            "//span[contains(@class, 'metascore_w')]",
            "//div[@class='score_wrapper']//div[@class='metascore_w']"
        ];

        foreach ($selectors as $selector) {
            $nodes = $xpath->query($selector);
            if ($nodes->length > 0) {
                $score = trim($nodes->item(0)->textContent);
                if (is_numeric($score)) {
                    return (int)$score;
                }
            }
        }

        return null;
    }

    /**
     * Extrae el User Score del XPath.
     * 
     * @param \DOMXPath $xpath Objeto XPath del DOM.
     * @return float|null User score o null.
     */
    private static function extractUserscore(\DOMXPath $xpath): ?float
    {
        $selectors = [
            "//div[contains(@class, 'c-siteReviewScore_user')]//span",
            "//div[contains(@class, 'userscore_wrap')]//div[contains(@class, 'metascore_w')]"
        ];

        foreach ($selectors as $selector) {
            $nodes = $xpath->query($selector);
            if ($nodes->length > 0) {
                $score = trim($nodes->item(0)->textContent);
                if (is_numeric($score)) {
                    return (float)$score;
                }
            }
        }

        return null;
    }

    /**
     * Extrae el resumen/descripción del XPath.
     * 
     * @param \DOMXPath $xpath Objeto XPath del DOM.
     * @return string Resumen o cadena vacía.
     */
    private static function extractSummary(\DOMXPath $xpath): string
    {
        $selectors = [
            "//div[contains(@class, 'c-productHero_description')]//span",
            "//div[contains(@class, 'summary_deck')]//span[contains(@class, 'blurb_expanded')]",
            "//div[@class='summary_deck']//span[@class='data']"
        ];

        foreach ($selectors as $selector) {
            $nodes = $xpath->query($selector);
            if ($nodes->length > 0) {
                return trim($nodes->item(0)->textContent);
            }
        }

        return '';
    }
}
