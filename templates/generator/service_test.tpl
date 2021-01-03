<?php
declare(strict_types = 1);
namespace %namespace%\Test\TestCase\Service;

use Origin\TestSuite\OriginTestCase;
use %namespace%\Service\%class%;

class %class%Test extends OriginTestCase
{
     public function testExecute()
    {
        $result = (new %class%())->dispatch();
        $this->assertTrue($result->success()); 
    }
}