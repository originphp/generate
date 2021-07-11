<?php
declare(strict_types = 1);
namespace %namespace%\Test\TestCase\Model\Entity;

use Origin\TestSuite\OriginTestCase;
use %namespace%\Model\Entity\%class%;

class %class%Test extends OriginTestCase
{
    public function testSample(): void
    {
        $data = [];
        $options = [];

        $entity = new %class%($data, $options);
        $entity->test = true;
        $this->assertTrue($entity->has('test'));
    }
}