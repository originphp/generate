<?php
namespace %namespace%\Test\Http\Controller;

use Origin\TestSuite\OriginTestCase;
use Origin\TestSuite\IntegrationTestTrait;
use Origin\Model\ModelRegistry;

/**
 * @property \%namespace%\Model\%model% $%model%
 */
class %controller%ControllerTest extends OriginTestCase
{
    use IntegrationTestTrait;

    protected $fixtures = ['%model%'];

    protected function startup(): void
    {
        $this->%model% = ModelRegistry::get('%model%');
    }
}
