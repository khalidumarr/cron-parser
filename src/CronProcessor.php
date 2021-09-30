<?php

namespace CronParser;

use JetBrains\PhpStorm\Pure;

/**
 * Parses the cron the string
 */
class CronProcessor
{
    /**
     * @var Parsers\ParserFactoryInterface
     */
    private Parsers\ParserFactoryInterface $parserFactory;

    /**
     * @var Field[]
     */
    private array $definedFields;

    /**
     * @param Parsers\ParserFactoryInterface $parserFactory
     */
    #[Pure] public function __construct(Parsers\ParserFactoryInterface $parserFactory)
    {
        $this->parserFactory = $parserFactory;

        $this->definedFields  = [
            new Field('minute', 0, 59),
            new Field('hour', 0, 23),
            new Field('day of month', 1, 31),
            new Field('month', 1, 12),
            new Field('day of week', 0, 6),
        ];
    }

    /**
     * main process function
     */
    public function process($expression) : Cron
    {
        $processedFields = $this->processFields($expression->getFields());
        return new Cron($processedFields, $expression->getCommand());
    }

    private function processFields($inputFields) : array
    {
        $fields = [];
        foreach ($inputFields as $key => $value) {
            $field = clone $this->definedFields[$key];
            $parser = $this->parserFactory->Make($value);
            $field->setNextRuns($parser->parse($value, $field));
            $fields[] = $field;
        }

        return $fields;
    }
}