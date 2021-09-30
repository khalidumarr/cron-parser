<?php

namespace CronParser\Outputs;

use CronParser\Cron;

class SimpleOutput implements OutputInterface
{
    const SPACES = 15;

    public function display(Cron $cron): void
    {
        foreach ($cron->getFields() as $field) {
            echo $field->getName() . $this->makeSpace($field->getName()) . implode(" ", $field->getNextRuns()) . "\n";
        }

        echo "command" . $this->makeSpace("command") . $cron->getCommand() . "\n";
    }

    private function makeSpace($field) : string
    {
        return str_repeat(" ", self::SPACES - strlen($field));
    }
}