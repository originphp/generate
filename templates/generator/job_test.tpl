<?php
declare(strict_types = 1);
namespace %namespace%\Test\TestCase\Job;

use Origin\TestSuite\OriginTestCase;
use %namespace%\Job\%class%Job;

class %class%JobTest extends OriginTestCase
{
    public function testExecute()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        $result = (new %class%Job())->dispatchNow();
        $this->assertTrue($result); 
    }
}