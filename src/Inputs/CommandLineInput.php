<?php

namespace CronParser\Inputs;

class CommandLineInput implements InputInterface {
    function getInput() : string {
        echo "Enter your cron string : ";
        return fgets(STDIN);
    }
}