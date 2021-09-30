<?php

namespace CronParser\Exceptions;

class MaxLimitException extends \Exception
{
    public function __construct($field, $code = "", $previous = "")
    {
        $message = $this->generateMessage() . $field;
        parent::__construct($message, $code, $previous);
    }

    public function generateMessage() : string
    {
        return "Max limit of value is reached for ";
    }
}