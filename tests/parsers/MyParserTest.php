<?php

namespace Tests\CronParser\Parsers;

use CronParser\Parsers\MyParser;
use PHPUnit\Framework\TestCase;

class MyParserTest extends TestCase
{

    public function testTesting()
    {
        $parser = new MyParser();
        $this->assertEquals($parser->testing(), "called");
    }
}
