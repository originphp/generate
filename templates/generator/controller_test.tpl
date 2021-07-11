<?php
declare(strict_types = 1);
namespace %namespace%\Test\TestCase\Http\Controller;

use Origin\TestSuite\OriginTestCase;
use Origin\TestSuite\IntegrationTestTrait;

/**
 * @property \App\Model\%model% $%model%
 */
class %class%ControllerTest extends OriginTestCase
{
    use IntegrationTestTrait;

    protected $fixtures = ['%model%'];

    protected function startup(): void
    {
        $this->loadModel('%model%');
    }

    public function testIndexExample(): void
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        $this->get('/%underscored%/index');
        $this->assertResponseOk();
        $this->assertResponseContains('<h2>%human%</h2>');
    }

    public function testNotFoundExample(): void
    {
        $this->get('/%underscored%/does-not-exist');
        $this->assertResponseNotFound();
    }
    
%methods%
}