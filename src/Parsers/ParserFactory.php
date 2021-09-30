<?php

namespace CronParser\Parsers;

class ParserFactory implements ParserFactoryInterface {
    public function Make(string $value): ParserInterface
    {
        if (strpos($value, DelimeterEnum::FREQUENCY) !== false) {
            return new FrequencyParser();
        } elseif (strpos($value, DelimeterEnum::LIST) !== false) {
            return new ListParser();
        } elseif (strpos($value, DelimeterEnum::RANGE) !== false) {
            return new RangeParser();
        } else{
            return new ConstantParser();
        }
    }
}