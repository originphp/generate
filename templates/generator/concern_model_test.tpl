<?php
declare(strict_types = 1);
namespace %namespace%\Test\TestCase\Model\Concern;

use Origin\TestSuite\OriginTestCase;
use %namespace%\Model\Concern\%class%;
use Origin\Model\Model;

class User extends Model
{
    use %class%;
}

/**
 * @property \App\Model\User $User
 */
class %class%Test extends OriginTestCase
{
    protected $fixtures = ['User'];

    protected function startup(): void
    {
        $this->loadModel('User', ['className' => User::class]);
    }

    public function testConcernMethod()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}