<?php
namespace %namespace%\Test\TestCase\Console\Command;

use Origin\TestSuite\OriginTestCase;
use Origin\TestSuite\ConsoleIntegrationTestTrait;

class %class%CommandTest extends OriginTestCase
{
    use ConsoleIntegrationTestTrait;

    public function testExecute()
    {
        $this->exec('%custom%');
        $this->assertExitSuccess();
        $this->assertOutputContains('some text');
    }
}