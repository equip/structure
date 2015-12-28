<?php

namespace Destrukt;

class OrderedListTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->struct = new OrderedList([
            'apple',
            'banana',
            'cherry',
            'orange',
            'blueberry',
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
        $this->assertSame('apple', $this->struct[0]);
    }

    public function testExists()
    {
        $this->assertTrue($this->struct->hasValue('banana'));
        $this->assertFalse($this->struct->hasValue('cabbage'));
    }

    public function testSorting()
    {
        $array = $this->struct->toArray();
        $copy  = $array;

        sort($array);

        $this->assertEquals($array, $copy);
    }

    public function testChangeSorting()
    {
        $copy = $this->struct->withSorter('rsort');

        $array   = $this->struct->toArray();
        $flipped = $copy->toArray();

        $this->assertSame($array, array_reverse($flipped));

        $unchanged = $copy->withSorter('rsort');

        $this->assertSame($copy, $unchanged);
    }

    public function testReplace()
    {
        $list = $this->struct;
        $copy = $list->withData([
            'grape',
            'melon',
        ]);

        $this->assertEquals(5, count($list));
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
        $copy = $list->withValue('fig');

        $this->assertEquals(count($copy), count($list) + 1);
    }

    public function testRemove()
    {
        $set  = $this->struct;
        $copy = $set->withoutValue('apple');

        $this->assertTrue($set->hasValue('apple'));
        $this->assertFalse($copy->hasValue('apple'));
    }

    public function testNotUnique()
    {
        $array = $this->struct
            ->withValue('pineapple')
            ->withValue('pineapple')
            ->toArray();

        $this->assertNotEquals($array, array_unique($array));
    }
}
