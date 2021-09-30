<?php

namespace Tests\CronParser\Parsers;

use CronParser\Exceptions\InvalidArgumentException;
use CronParser\Exceptions\MaxLimitException;
use CronParser\Exceptions\MinLimitException;
use CronParser\Field;
use CronParser\Parsers\ConstantParser;
use PHPUnit\Framework\TestCase;

class ConstantParserTest extends TestCase
{
    /**
     * @throws MaxLimitException
     * @throws MinLimitException
     */
    public function testParse()
    {
        $parser = new ConstantParser();

        $field = new Field("minute", 0, 59);
        $result = $parser->parse(5, $field);
        $this->assertEquals(5, $result[0]);
    }

    /**
     * @throws MaxLimitException|MinLimitException
     */
    public function testParseThrowsMaxException()
    {
        $parser = new ConstantParser();

        $field = new Field("minute", 0, 59);
        $this->expectException(MaxLimitException::class);
        $parser->parse(60, $field);
    }

    /**
     * @throws MaxLimitException|MinLimitException
     */
    public function testParseThrowsMinException()
    {
        $parser = new ConstantParser();

        $field = new Field("minute", 0, 59);
        $this->expectException(MinLimitException::class);
        $parser->parse(-2, $field);
    }

    /**
     * @throws MaxLimitException|MinLimitException
     */
    public function testParseThrowsInvalidArgumentException()
    {
        $parser = new ConstantParser();

        $field = new Field("minute", 0, 59);
        $this->expectException(InvalidArgumentException::class);
        $parser->parse("abc", $field);
    }
}
