<?php

namespace Shadowhand\Test\Destrukt;

use Shadowhand\Destrukt\OrderedList;

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

    public function testSorting()
    {
        $array = $this->struct->toArray();
        $copy  = $array;

        sort($array);

        $this->assertEquals($array, $copy);
    }

    public function testChangeSorting()
    {
        $array   = $this->struct->toArray();
        $flipped = $this->struct->withSorter('rsort')->toArray();

        $this->assertSame($array, array_reverse($flipped));
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

    public function testNotUnique()
    {
        $array = $this->struct
            ->withValue('pineapple')
            ->withValue('pineapple')
            ->toArray();

        $this->assertNotEquals($array, array_unique($array));
    }
}
