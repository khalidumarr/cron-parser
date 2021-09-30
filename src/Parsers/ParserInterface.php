<?php

namespace CronParser\Parsers;

interface ParserInterface{
    public static function parse(string $value, \Field $field) : array;
}