<?php
namespace %namespace%\Test\Service;

use Origin\TestSuite\OriginTestCase;
use %namespace%\Service\%class%Service;

class %class%ServiceTest extends OriginTestCase
{
     public function testExecute()
    {
        $result = (new %class%Service())->dispatch();
        $this->assertTrue($result->success()); 
    }
}