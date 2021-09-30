<?php

namespace CronParser\Parsers;
use CronParser\Exceptions\MaxLimitException;
use CronParser\Exceptions\MinLimitException;
use CronParser\Field;

class ConstantParser implements ParserInterface {
    /**
     * @throws MaxLimitException
     * @throws MinLimitException
     */
    public function parse(string $value, Field $field): array
    {
        assert($field->validate($value), true);
        return [$value];
    }
}