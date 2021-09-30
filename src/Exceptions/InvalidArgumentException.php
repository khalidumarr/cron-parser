<?php

namespace CronParser\Exceptions;

class InvalidArgumentException extends \Exception
{
    public function __construct($field = "", $code = 0, $previous = null)
    {
        $message = $this->generateMessage() . $field;
        parent::__construct($message, $code, $previous);
    }

    public function generateMessage() : string
    {
        return "Invalid Argument passed for ";
    }
}