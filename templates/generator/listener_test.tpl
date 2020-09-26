<?php
declare(strict_types = 1);
namespace %namespace%\Test\TestCase\Listener;

use Origin\TestSuite\OriginTestCase;
use %namespace%\Listener\%class%Listener;

class %class%ListenerTest extends OriginTestCase
{
    protected function testCreate(): void
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        $listener = new %class%Listener();
    }
}