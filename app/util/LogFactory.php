<?php

namespace Dwes\ProyectoVideoclub\Util;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;

/**
 * Factoría para la creación y configuración de loggers.
 * 
 * @package Dwes\ProyectoVideoclub\Util
 */
class LogFactory
{
    /**
     * Crea y configura una instancia de LoggerInterface.
     * 
     * @param string $channel Nombre del canal de log.
     * @return LoggerInterface Instancia del logger configurada.
     */
    public static function getLogger(string $channel = 'VideoclubLogger'): LoggerInterface
    {
        $logger = new Logger($channel);

        $logger->pushHandler(
            new StreamHandler(
                __DIR__ . '/../../logs/videoclub.log',
                Logger::DEBUG
            )
        );

        return $logger;
    }
}
