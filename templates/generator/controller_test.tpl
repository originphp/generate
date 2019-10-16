<?php
namespace %namespace%\Test\Http\Controller;

use Origin\TestSuite\OriginTestCase;
use Origin\TestSuite\IntegrationTestTrait;

/**
 * @property \App\Model\%model% $%model%
 */
class %class%ControllerTest extends OriginTestCase
{
    use IntegrationTestTrait;

    protected $fixtures = ['%model%'];

    protected function startup() : void
    {
        $this->loadModel('%model%');
    }

    public function testIndexExample()
    {
        $this->get('/%underscored%/index');
        $this->assertResponseOk();
        $this->assertResponseContains('<h2>%human%</h2>');
    }

    public function testNotFoundExample()
    {
        $this->get('/%underscored%/does-not-exist');
        $this->assertResponseNotFound();
    }
    
%methods%
}