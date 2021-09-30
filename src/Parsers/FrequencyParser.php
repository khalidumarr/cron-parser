<?php

namespace CronParser\Parsers;
use CronParser\Exceptions\InvalidArgumentException;
use CronParser\Exceptions\MaxLimitException;
use CronParser\Exceptions\MinLimitException;
use CronParser\Field;

class FrequencyParser implements ParserInterface {
    private RangeParser $rangeParser;

    /**
     * @param RangeParser $rangeParser
     */
    public function __construct(RangeParser $rangeParser)
    {
        $this->rangeParser = $rangeParser;
    }

    /**
     * @throws MaxLimitException
     * @throws InvalidArgumentException
     * @throws MinLimitException
     */
    public function parse(string $value, Field $field): array
    {
        list($range, $frequency) = explode("/", $value);
        assert($field->validate($frequency), true);
        $this->rangeParser->setFrequency($frequency);

        // string contain * (means full range)
        if (str_contains($range, DelimeterEnum::ALL)) {
            $range = $field->getMin() . DelimeterEnum::RANGE .  $field->getMax();
        }

        return $this->rangeParser->parse($range, $field);
    }
}