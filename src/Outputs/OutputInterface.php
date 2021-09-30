<?php

namespace CronParser\Outputs;

use CronParser\Cron;

interface OutputInterface
{
    public function display(Cron $cron) : void;
}