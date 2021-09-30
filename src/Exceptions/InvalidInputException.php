<?php

namespace CronParser\Exceptions;

class InvalidInputException extends \Exception
{
    public function __construct($message = "", $code = 0, $previous = NULL)
    {
        if ($message == "") {
            $message = $this->generateMessage();
        }
        parent::__construct($message, $code, $previous);
    }

    public function generateMessage() : string
    {
        return "Invalid input, number of chunks required in input are 6";
    }
}