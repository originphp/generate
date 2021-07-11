<?php
declare(strict_types = 1);
namespace %namespace%\Test\TestCase\Mailbox;

use %namespace%\Mailbox\%class%Mailbox;
use Origin\Mailbox\Mailbox;
use Origin\TestSuite\OriginTestCase;
use Origin\Mailbox\Model\InboundEmail;

class %class%MailboxTest extends OriginTestCase
{
    protected $fixtures = ['Mailbox', 'Queue'];

    protected function startup(): void
    {
        $this->InboundEmail = $this->loadModel('InboundEmail', [
            'className' => InboundEmail::class
        ]);
    }

   public function test RouteMatching(): void
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );

        $mailbox = Mailbox::mailbox(['support@yourdomain.com']);
        $this->assertEquals(%class%Mailbox::class, $mailbox);
    }

    public function testDelivered(): void
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        $inboundEmail = $this->InboundEmail->first();
        $this->assertTrue((new %class%Mailbox($inboundEmail))->dispatch());
    }
}
