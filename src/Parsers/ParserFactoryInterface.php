<?php

namespace CronParser\Parsers;

interface ParserFactoryInterface
{
    public function Make(string $value) : ParserInterface;
}