<?php

namespace CronParser;

use CronParser\Exceptions\InvalidArgumentException;
use CronParser\Exceptions\MaxLimitException;
use CronParser\Exceptions\MinLimitException;

class Field{
    /**
     * @var string
     */
    private string $name;
    /**
     * @var int
     */
    private int $min;
    /**
     * @var int
     */
    private int $max;
    /**
     * @var array
     */
    private array $nextRuns;

    /**
     * @param string $name
     * @param int $min
     * @param int $max
     * @param array $nextRuns
     */
    public function __construct(string $name, int $min, int $max, array $nextRuns = [])
    {
        $this->name = $name;
        $this->min = $min;
        $this->max = $max;
        $this->nextRuns = $nextRuns;
    }

    /**
     * @throws MinLimitException
     * @throws MaxLimitException
     * @throws InvalidArgumentException
     */
    public function validate($value) : bool
    {
        if (!is_numeric($value)) {
            throw new InvalidArgumentException("Non numeric value sent");
        }

        if ($value > $this->getMax()) {
            throw new MaxLimitException($this->getName());
        } elseif ($value < $this->getMin()) {
            throw new MinLimitException($this->getName());
        }

        return true;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @param int $min
     */
    public function setMin(int $min): void
    {
        $this->min = $min;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @param int $max
     */
    public function setMax(int $max): void
    {
        $this->max = $max;
    }

    /**
     * @return array
     */
    public function getNextRuns(): array
    {
        return $this->nextRuns;
    }

    /**
     * @param array $nextRuns
     */
    public function setNextRuns(array $nextRuns): void
    {
        $this->nextRuns = $nextRuns;
    }
}