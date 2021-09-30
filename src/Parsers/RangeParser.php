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
     * @var bool
     */
    private bool $fullRange;

    /**
     * @param int $frequency
     */
    public function __construct(int $frequency = 1, bool $fullRange = false)
    {
        $this->frequency = $frequency;
        $this->fullRange = $fullRange;
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

        if ($this->isFullRange()) {
            list($min, $max) = [$field->getMin(), $field->getMax()];
        } else {
            list($min, $max) = explode("-", $value);
        }

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

    /**
     * @return bool
     */
    public function isFullRange(): bool
    {
        return $this->fullRange;
    }

    /**
     * @param bool $fullRange
     */
    public function setFullRange(bool $fullRange): void
    {
        $this->fullRange = $fullRange;
    }
}