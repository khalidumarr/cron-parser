<?php

namespace Tests\CronParser\Parsers;

use CronParser\Exceptions\InvalidArgumentException;
use CronParser\Exceptions\MaxLimitException;
use CronParser\Exceptions\MinLimitException;
use CronParser\Field;
use CronParser\Parsers\RangeParser;
use PHPUnit\Framework\TestCase;

class RangeParserTest extends TestCase
{

    /**
     * @throws MaxLimitException
     * @throws InvalidArgumentException
     * @throws MinLimitException
     */
    public function testParse()
    {
        $parser = new RangeParser();
        $field = new Field("hour", 0, 23);
        $result = $parser->parse("1-5", $field);
        $this->assertEqualsCanonicalizing([1,2,3,4,5], $result);

        $result = $parser->parse("5-8", $field);
        $this->assertEqualsCanonicalizing([5,6,7,8], $result);
    }

    /**
     * @throws MaxLimitException
     * @throws InvalidArgumentException
     * @throws MinLimitException
     */
    public function testParseFullRange()
    {
        $parser = new RangeParser(1, true);
        $field = new Field("months", 1, 12);
        $result = $parser->parse("*", $field);
        $this->assertEqualsCanonicalizing([1,2,3,4,5,6,7,8,9,10,11,12], $result);
    }

    /**
     * @throws MaxLimitException
     * @throws InvalidArgumentException
     * @throws MinLimitException
     */
    public function testParserThrowsMaxLimitException()
    {
        $parser = new RangeParser();
        $field = new Field("hour", 0, 23);
        $this->expectException(MaxLimitException::class);
        $parser->parse("1-52", $field);
    }

    /**
     * @throws MaxLimitException
     * @throws InvalidArgumentException
     * @throws MinLimitException
     */
    public function testParserThrowsInvalidArgumentException()
    {
        $parser = new RangeParser();
        $field = new Field("hour", 0, 23);
        $this->expectException(InvalidArgumentException::class);
        $parser->parse("-1-52", $field);
    }
}
