<?php

namespace Tests\CronParser\Outputs;

use CronParser\Cron;
use CronParser\Field;
use CronParser\Outputs\SimpleOutput;
use PHPUnit\Framework\TestCase;

class SimpleOutputTest extends TestCase
{

    public function testDisplay()
    {
        $cron = new Cron([new Field("minute", 0, 59, [1,2,3,4])], "test");
        $output = new SimpleOutput();
        $this->expectOutputString("minute         1 2 3 4\ncommand        test\n");
        $output->display($cron);
    }
}
