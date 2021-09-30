<?php

namespace Tests\CronParser\Parsers;

use CronParser\Exceptions\InvalidArgumentException;
use CronParser\Exceptions\MaxLimitException;
use CronParser\Exceptions\MinLimitException;
use CronParser\Field;
use CronParser\Parsers\ListParser;
use PHPUnit\Framework\TestCase;

class ListParserTest extends TestCase
{

    /**
     * @throws MaxLimitException
     * @throws MinLimitException
     */
    public function testParse()
    {
        $parser = new ListParser();
        $field = new Field("hour", 0, 23);
        $result = $parser->parse("1,2,3", $field);
        $this->assertEqualsCanonicalizing([1,2,3], $result);
    }

    /**
     * @throws MaxLimitException
     * @throws MinLimitException
     */
    public function testParseThrowsMaxLimitException()
    {
        $parser = new ListParser();
        $field = new Field("hour", 0, 11);
        $this->expectException(MaxLimitException::class);
        $parser->parse("1,2,33", $field);
    }

    /**
     * @throws MaxLimitException
     * @throws MinLimitException
     */
    public function testParseThrowsMaxLimitExceptionForMiddleElement()
    {
        $parser = new ListParser();
        $field = new Field("hour", 0, 11);
        $this->expectException(MaxLimitException::class);
        $parser->parse("1,55,33", $field);
    }

    public function testParseThrowsMinLimitException()
    {
        $parser = new ListParser();
        $field = new Field("hour", 0, 11);
        $this->expectException(MinLimitException::class);
        $parser->parse("1,-2,23", $field);
    }
}
