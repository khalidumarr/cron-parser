<?php

namespace CronParser\Parsers;

use JetBrains\PhpStorm\Pure;

class ParserFactory implements ParserFactoryInterface {
    #[Pure] public function Make(string $value): ParserInterface
    {
        if (str_contains($value, DelimeterEnum::FREQUENCY)) {
            return new FrequencyParser(new RangeParser());
        } elseif (str_contains($value, DelimeterEnum::LIST)) {
            return new ListParser();
        } elseif (str_contains($value, DelimeterEnum::RANGE)) {
            return new RangeParser();
        } elseif ($value == DelimeterEnum::ALL) {
            return new RangeParser(1, true);
        } else{
            return new ConstantParser();
        }
    }
}