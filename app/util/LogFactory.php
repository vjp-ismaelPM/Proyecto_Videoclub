<?php

namespace Dwes\ProyectoVideoclub\Util;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Level;

use Psr\Log\LoggerInterface;

class LogFactory {
    public static function getLogger(string $channel = 'VideoclubLogger'): LoggerInterface {
        $logger = new Logger($channel);
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/videoclub.log', Level::Debug));
        return $logger;
    }
}
