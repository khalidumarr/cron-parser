<?php

namespace CronParser\Outputs;

use CronParser\Cron;

class SimpleOutput implements OutputInterface
{
    public function display(Cron $cron): void
    {
        foreach ($cron->getFields() as $field) {
            echo $field->getName() . " " . print_r($field->getNextRuns()) . " " . $cron->getCommand();
        }
    }
}