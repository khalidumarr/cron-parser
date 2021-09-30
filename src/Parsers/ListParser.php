<?php

namespace CronParser\Parsers;
use CronParser\Exceptions\MaxLimitException;
use CronParser\Exceptions\MinLimitException;
use CronParser\Field;

class ListParser implements ParserInterface {
    /**
     * @throws MaxLimitException
     * @throws MinLimitException
     */
    public function parse(string $value, Field $field): array
    {
        $iterations = explode(",", $value);
        foreach ($iterations as $iteration) {
            assert($field->validate($iteration), true);
        }

        return $iterations;
    }
}