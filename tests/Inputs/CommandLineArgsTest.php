<?php

namespace Tests\CronParser\Inputs;

use CronParser\Inputs\CommandLineArgs;
use PHPUnit\Framework\TestCase;

class CommandLineArgsTest extends TestCase
{

    public function testGetInput()
    {
        $commandLineArgs = new CommandLineArgs();
        $this->assertNotEmpty($commandLineArgs->getInput());
    }
}
