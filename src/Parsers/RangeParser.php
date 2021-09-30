<?php

namespace CronParser\Parsers;
use CronParser\Exceptions\InvalidArgumentException;
use CronParser\Exceptions\MaxLimitException;
use CronParser\Exceptions\MinLimitException;
use CronParser\Field;
use function PHPUnit\Framework\assertTrue;

class RangeParser implements ParserInterface {
    /**
     * @var int
     */
    private int $frequency;

    /**
     * @param int $frequency
     */
    public function __construct(int $frequency = 1)
    {
        $this->frequency = $frequency;
    }

    /**
     * @throws MaxLimitException
     * @throws MinLimitException
     * @throws InvalidArgumentException
     */
    public function parse(string $value, Field $field): array
    {
        if (substr_count($value, "-") > 1){
            throw new InvalidArgumentException($field->getName());
        }

        list($min, $max) = explode("-", $value);
        assert($field->validate($min), true);
        assert($field->validate($max), true);

        if ($this->getFrequency() > ($max - $min)) {
            throw new MaxLimitException($field->getName());
        }

        $result = [];
        for ($i = $min; $i <= $max; $i = $i + $this->getFrequency()) {
            assert($field->validate($i), true);
                $result[] = $i;
        }

        return $result;
    }

    /**
     * @return int
     */
    public function getFrequency(): int
    {
        return $this->frequency;
    }

    /**
     * @param int $frequency
     */
    public function setFrequency(int $frequency): void
    {
        $this->frequency = $frequency;
    }

}