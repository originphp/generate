<?php
declare(strict_types = 1);
namespace %namespace%\Test\TestCase\Console\Command;

use Origin\TestSuite\OriginTestCase;
use Origin\TestSuite\ConsoleIntegrationTestTrait;

class %class%CommandTest extends OriginTestCase
{
    use ConsoleIntegrationTestTrait;

    public function testExecute()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );

        $this->exec('%custom%');
        $this->assertExitSuccess();
        $this->assertOutputContains('some text');
    }
}