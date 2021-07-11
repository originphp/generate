<?php
declare(strict_types = 1);
namespace %namespace%\Test\TestCase\Http\Middleware;

use Origin\TestSuite\OriginTestCase;
use Origin\Http\Request;
use Origin\Http\Response;
use %namespace%\Http\Middleware\%class%Middleware;

class %class%MiddlewareTest extends OriginTestCase
{
    /**
    * @var \Origin\Http\Request
    */
    protected $request = null;

    /**
    * @var \Origin\Http\Response
    */
    protected $response = null;

    protected function startup(): void
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function testRun(): void 
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );

        // Invoke the middleware
        $middleware = new %class%Middleware();
        $middleware($this->request, $this->response);
    }
}