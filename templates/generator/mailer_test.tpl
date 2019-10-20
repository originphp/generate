<?php
namespace %namespace%\Test\Mailer;

use Origin\TestSuite\OriginTestCase;
use %namespace%\Mailer\%class%Mailer;

class %class%MailerTest extends OriginTestCase
{
    protected $fixtures = ['User'];

    protected function startup() : void
    {
        $this->loadModel('User');
    }
    
    public function testExecute()
    {
        $user = $this->User->find('first', ['conditions' => ['id' => 1000]]);
        $message = (new %class%Mailer())->dispatch($user);
        $this->assertStringContainsString('To: user@example.com',$message->header());
        $this->assertStringContainsString('From: user@example.com',$message->header());
        $this->assertStringContainsString('Hello user',$message->body());
    }
}