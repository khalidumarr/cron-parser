<?php

namespace CronParser;

class Cron
{
    /**
     * @var array
     */
    private array $fields;

    /**
     * @var string
     */
    private string $command;

    /**
     * @param array $fields
     * @param string $command
     */
    public function __construct(array $fields, string $command)
    {
        $this->fields = $fields;
        $this->command = $command;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * @param string $command
     */
    public function setCommand(string $command): void
    {
        $this->command = $command;
    }
}