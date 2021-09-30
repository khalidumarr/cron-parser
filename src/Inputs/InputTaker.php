<?php

namespace CronParser\Inputs;

use CronParser\Exceptions\InvalidInputExceptionException;

class InputTaker implements InputTakerInterface {

    /**
     * @var InputInterface
     */
    private InputInterface $source;

    /**
     * @param InputInterface $source
     */
    public function __construct(InputInterface $source)
    {
        $this->source = $source;
    }

    /**
     * @throws InvalidInputExceptionException
     */
    public function takeInput() : Expression {
        $input = $this->source->getInput();
        $chunks = explode(" ", $input);

        if (count($chunks) != 6) {
            throw new InvalidInputExceptionException();
        }

        return new Expression(array_slice($chunks, 0, (count($chunks) - 1)),
            $chunks[array_key_last($chunks)]);
    }
}