<?php
declare(strict_types = 1);
namespace %namespace%\Test\TestCase\Model\Repository;

use Origin\TestSuite\OriginTestCase;
use %namespace%\Model\Repository\%class%Repository;

class %class%RepositoryTest extends OriginTestCase
{
    protected $fixtures = ['%model%'];

    public function testRepositoryMethod()
    {
        $repository = new %class%Repository();
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
