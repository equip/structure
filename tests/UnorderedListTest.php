<?php

namespace Destrukt;

class UnorderedListTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->struct = new UnorderedList([
            'red',
            'green',
            'blue',
            'white',
            'black',
            'white',
        ]);
    }

    // ArrayAccess
    public function testOffsetExists()
    {
        $this->assertTrue(isset($this->struct[0]));
        $this->assertFalse(isset($this->struct[PHP_INT_MAX]));
    }

    // ArrayAccess
    public function testOffsetGet()
    {
        $this->assertSame('red', $this->struct[0]);
    }

    public function testExists()
    {
        $this->assertTrue($this->struct->hasValue('red'));
        $this->assertFalse($this->struct->hasValue('beans'));
    }

    public function testReplace()
    {
        $list = $this->struct;
        $copy = $list->withData([
            'yellow',
            'orange',
        ]);

        $this->assertEquals(6, count($list));
        $this->assertEquals(2, count($copy));

        $unchanged = $copy->withData($copy->getData());

        $this->assertSame($copy, $unchanged);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testReplaceFailure()
    {
        $this->struct->withData([
            'actually' => 'hash',
        ]);
    }

    public function testAppend()
    {
        $list = $this->struct;
        $copy = $list->withValue('red');

        $this->assertEquals(6, count($list));
        $this->assertEquals(7, count($copy));
    }

    public function testRemove()
    {
        $set  = $this->struct;
        $copy = $set->withoutValue('green');

        $this->assertTrue($set->hasValue('green'));
        $this->assertFalse($copy->hasValue('green'));
    }

    public function testNotUnique()
    {
        $list = $this->struct->toArray();

        $this->assertNotEquals($list, array_unique($list));
    }
}
