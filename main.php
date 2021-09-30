<?php

require "vendor/autoload.php";

use CronParser\Inputs\CommandLineArgs;
use CronParser\Inputs\InputTaker;
use CronParser\CronProcessor;
use CronParser\Parsers\ParserFactory;
use CronParser\Outputs\SimpleOutput;

// Taking input
$commandLineInput = new CommandLineArgs();
$inputTaker = new InputTaker($commandLineInput);
try {
    $expression = $inputTaker->takeInput();
} catch (\Exception $e) {
    echo "\033[31m Exception in Input \033[0m " . $e->getMessage();
    exit(1);
}

// processing Cron
$parsersFactory = new ParserFactory();
$processor = new CronProcessor($parsersFactory);

$cron = null;
try {
    $cron = $processor->process($expression);
} catch (\Exception $e) {
    echo "\033[31m Exception in Processing \033[0m " . $e->getMessage();
    exit(1);
}

// displaying output
$output = new SimpleOutput();
$output->display($cron);
