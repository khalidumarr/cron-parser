<?php

namespace Tests\CronParser\Parsers;

use CronParser\Parsers\ConstantParser;
use CronParser\Parsers\FrequencyParser;
use CronParser\Parsers\ParserFactory;
use CronParser\Parsers\RangeParser;
use CronParser\Parsers\ListParser;
use PHPUnit\Framework\TestCase;

class ParserFactoryTest extends TestCase
{

    public function testMake()
    {
        $factory = new ParserFactory();
        $this->assertInstanceOf(FrequencyParser::class, $factory->Make("*/2"));
        $this->assertInstanceOf(ListParser::class, $factory->Make("1,2"));
        $this->assertInstanceOf(RangeParser::class, $factory->Make("1-2"));
        $this->assertInstanceOf(ConstantParser::class, $factory->Make("2"));

    }
}
