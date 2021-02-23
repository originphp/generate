<?php
declare(strict_types = 1);
namespace %namespace%\Test\TestCase\Task;

use Origin\TestSuite\OriginTestCase;
use %namespace%\Task\%class%Task;

class %class%TaskTest extends OriginTestCase
{
    public function testExecute()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        (new %class%Task())->dispatch();
    }
}