<?php

namespace CronParser\Inputs;

class CommandLineArgs implements InputInterface
{
    function getInput(): string
    {
        global $argv;

        if (!isset($argv[1])) {
            return "";
        }

        return $argv[1];
    }
}