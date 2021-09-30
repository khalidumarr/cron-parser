<?php

namespace Tests\CronParser\Parsers;

use CronParser\Exceptions\InvalidArgumentException;
use CronParser\Exceptions\MaxLimitException;
use CronParser\Exceptions\MinLimitException;
use CronParser\Field;
use CronParser\Parsers\FrequencyParser;
use CronParser\Parsers\RangeParser;
use PHPUnit\Framework\TestCase;

class FrequencyParserTest extends TestCase
{

    /**
     * @throws MaxLimitException
     * @throws MinLimitException
     * @throws InvalidArgumentException
     */
    public function testParse()
    {
        $parser = new FrequencyParser(new RangeParser());
        $field = new Field("minute", 0, 59);
        $result = $parser->parse("2-10/2", $field);
        $this->assertEqualsCanonicalizing([2,4,6,8,10], $result);

        $field = new Field("hour", 0, 23);
        $result = $parser->parse("*/2", $field);
        $this->assertEqualsCanonicalizing([0,2,4,6,8,10,12,14,16,18,20,22], $result);
    }

    /**
     * @throws MinLimitException
     * @throws InvalidArgumentException
     * @throws MaxLimitException
     */
    public function testParserThrowsMaxLimitException()
    {
        $parser = new FrequencyParser(new RangeParser());
        $field = new Field("hour", 0, 23);
        $this->expectException(MaxLimitException::class);
        $parser->parse("2-10/24", $field);
    }

    /**
     * @throws MinLimitException
     * @throws InvalidArgumentException
     * @throws MaxLimitException
     */
    public function testParserThrowsMaxLimitExceptionOutOfRange()
    {
        $parser = new FrequencyParser(new RangeParser());
        $field = new Field("minute", 0, 59);
        $this->expectException(MaxLimitException::class);
        $parser->parse("2-10/24", $field);
    }

    /**
     * @throws MinLimitException
     * @throws InvalidArgumentException
     * @throws MaxLimitException
     */
    public function testParserThrowsMinLimitException()
    {
        $parser = new FrequencyParser(new RangeParser());
        $field = new Field("day", 1, 31);
        $this->expectException(MinLimitException::class);
        $parser->parse("2-10/0", $field);
    }
}
