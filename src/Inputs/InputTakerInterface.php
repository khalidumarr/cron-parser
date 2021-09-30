<?php

namespace CronParser\Inputs;

interface InputTakerInterface
{
    public function takeInput() : Expression;
}