<?php

namespace CronParser\Parsers;
use CronParser\Field;

interface ParserInterface{
    public function parse(string $value, Field $field) : array;
}