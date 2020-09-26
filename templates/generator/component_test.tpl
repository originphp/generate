<?php
declare(strict_types = 1);
namespace %namespace%\Test\TestCase\Http\Controller\Component;

use Origin\Http\Controller\Controller;
use Origin\Http\Request;
use Origin\Http\Response;
use Origin\TestSuite\OriginTestCase;
use %namespace%\Http\Controller\Component\%class%Component;

class %class%ComponentTest extends OriginTestCase
{
    /**
    * @var \%namespace%\Controller\Component\%class%Component
    */
    protected $%class% = null;

    protected function startup(): void
    {
        $controller = new Controller(new Request(), new Response());
        $this->%class% = new %class%Component($controller);
    }
}