<?php
namespace %namespace%\Test\Model;

use Origin\TestSuite\OriginTestCase;

/**
 * @property \%namespace%\Model\%class% $%class%
 */
class %class%Test extends OriginTestCase
{
    protected $fixtures = ['%class%'];

    protected function startup() : void
    {
        $this->loadModel('%class%');
    }
}
