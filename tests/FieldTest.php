<?php

namespace Tests\CronParser;

use CronParser\Field;
use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{

    public function testTesting()
    {
        $field = new Field();
        $this->assertEquals($field->testing(), "hi");
    }
}
