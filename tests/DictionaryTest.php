<?php

namespace Shadowhand\Test\Destrukt;

use Shadowhand\Destrukt\Dictionary;

class HashTest extends StructTest
{
    public function setUp()
    {
        $this->struct = new Dictionary([
            'one'   => 1,
            'two'   => 2,
            'three' => 3,
            'four'  => 4,
        ]);
    }

    public function testReplace()
    {
        $hash = $this->struct;
        $copy = $hash->withData([
            'one'   => 'uno',
            'two'   => 'dos',
            'three' => 'tres',
            'four'  => 'quatro',
        ]);

        $this->assertEquals(1, $hash->getValue('one'));
        $this->assertEquals('uno', $copy->getValue('one'));
    }

    public function testAppend()
    {
        $hash = $this->struct;
        $copy = $hash->withValue('five', 5);

        $this->assertEquals(4, count($hash));
        $this->assertEquals(5, count($copy));

        $this->assertEquals(null, $hash->getValue('five'));

        $this->assertEquals(5, $copy->getValue('five'));
        $this->assertEquals(null, $copy->getValue('six'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAppendKeyFailure()
    {
        $this->struct->withValue(6, 'six');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testValidateFailure()
    {
        $this->struct->validate([3, 2, 1]);
    }
}
