<?php

namespace Tests\CronParser\Parsers;

use \CronParser\Parsers\FrequencyParser;
use \CronParser\Parsers\ParserFactory;
use PHPUnit\Framework\TestCase;

class ParserFactoryTest extends TestCase
{

    public function testMake()
    {
        $factory = new \CronParser\Parsers\ParserFactory();
        $this->assertObjectEquals(new FrequencyParser(), $factory->Make("*/2"));
    }
}
