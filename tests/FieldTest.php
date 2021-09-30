<?php

namespace Tests;

use CronParser\Exceptions\InvalidArgumentException;
use CronParser\Exceptions\MaxLimitException;
use CronParser\Exceptions\MinLimitException;
use CronParser\Field;
use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{

    public function testConstruction()
    {
        $field = new Field("minute", 0, 59);
        $this->assertEquals($field->getName(), "minute");
        $this->assertEquals($field->getMin(), 0);
        $this->assertEquals($field->getMax(), 59);
    }

    /**
     * @throws InvalidArgumentException
     * @throws MinLimitException
     * @throws MaxLimitException
     */
    public function testFieldMinLimitException()
    {
        $field = new Field("minute", 0, 59);
        $this->expectException(MinLimitException::class);
        $field->validate(-1);
    }

    /**
     * @throws InvalidArgumentException
     * @throws MinLimitException
     * @throws MaxLimitException
     */
    public function testFieldMaxLimitException()
    {
        $field = new Field("minute", 0, 59);
        $this->expectException(MaxLimitException::class);
        $field->validate(100);
    }

    /**
     * @throws InvalidArgumentException
     * @throws MinLimitException
     * @throws MaxLimitException
     */
    public function testFieldInvalidArgumentException()
    {
        $field = new Field("minute", 0, 59);
        $this->expectException(InvalidArgumentException::class);
        $field->validate("adsf");
    }
}
