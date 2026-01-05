<?php

namespace Dwes\Videoclub\Exception;

/**
 * Excepción lanzada cuando se intenta operar con un cliente que no existe.
 * 
 * @package Dwes\Videoclub\Exception
 */
class ClienteNoExisteException extends VideoclubException
{
    public function __construct($message = "El cliente no existe", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
