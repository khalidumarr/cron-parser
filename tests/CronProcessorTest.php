<?php

namespace Tests\CronParser;

use CronParser\CronProcessor;
use CronParser\Inputs\Expression;
use CronParser\Parsers\ParserFactory;
use PHPUnit\Framework\TestCase;

class CronProcessorTest extends TestCase
{

    public function testProcess()
    {
        $parsersFactory = new ParserFactory();
        $processor = new CronProcessor($parsersFactory);

        $expression = new Expression([
            "*/15", "0", "1,15", "*", "1-5"
        ], "/usr/bin/find");
        $cron = $processor->process($expression);

        // asserting command
        $this->assertEquals("/usr/bin/find", $cron->getCommand());

        // asserting minutes
        $this->assertEqualsCanonicalizing([0, 15, 30, 45], $cron->getFields()[0]->getNextRuns());

        // asserting hour
        $this->assertEqualsCanonicalizing([0], $cron->getFields()[1]->getNextRuns());

        // asserting days
        $this->assertEqualsCanonicalizing([1,15], $cron->getFields()[2]->getNextRuns());

        // asserting months
        $this->assertEqualsCanonicalizing([1,2,3,4,5,6,7,8,9,10,11,12], $cron->getFields()[3]->getNextRuns());

        // asserting week days
        $this->assertEqualsCanonicalizing([1,2,3,4,5], $cron->getFields()[4]->getNextRuns());
    }
}
