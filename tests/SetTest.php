<?php

namespace Shadowhand\Test\Destrukt;

use Shadowhand\Destrukt\Set;

class SetTest extends StructTest
{
    public function setUp()
    {
        $this->struct = new Set([
            'red',
            'green',
            'blue',
            'black',
            'white',
        ]);
    }

    public function testExists()
    {
        $this->assertTrue($this->struct->hasValue('red'));
        $this->assertTrue($this->struct->hasValue('white'));
        $this->assertFalse($this->struct->hasValue('yellow'));
    }

    public function testReplace()
    {
        $set = $this->struct;
        $copy = $set->withData([
            'yellow',
            'orange',
        ]);

        $this->assertEquals(5, count($set));
        $this->assertEquals(2, count($copy));

        $this->assertTrue($set->hasValue('white'));
        $this->assertFalse($copy->hasValue('white'));
        $this->assertTrue($copy->hasValue('yellow'));

        $unchanged = $copy->withData($copy->getData());

        $this->assertSame($copy, $unchanged);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testReplaceHashFailure()
    {
        $this->struct->withData([
            'test' => 'hash',
        ]);
    }

    public function testReplaceDuplicateFailure()
    {
        $copy = $this->struct->withData([
            'black',
            'blue',
            'black',
        ]);

        $this->assertEquals(['black', 'blue'], $copy->toArray());
    }

    public function testAppend()
    {
        $set  = $this->struct;
        $copy = $set->withValue('cyan');

        $this->assertEquals(5, count($set));
        $this->assertEquals(6, count($copy));

        $this->assertFalse($set->hasValue('cyan'));
        $this->assertTrue($copy->hasValue('cyan'));

        $unchanged = $copy->withValue('cyan');

        $this->assertSame($copy, $unchanged);
    }

    public function testUnique()
    {
        $set = $this->struct->toArray();

        $this->assertEquals($set, array_unique($set));
    }

    public function testRemoveValue()
    {
        $set  = $this->struct;
        $copy = $set->withoutValue('blue');

        $this->assertTrue($set->hasValue('blue'));
        $this->assertFalse($copy->hasValue('blue'));

        $unchanged = $copy->withoutValue('blue');

        $this->assertSame($copy, $unchanged);
    }

    public function testDifference()
    {
        $foo = new Set(['red', 'green', 'blue']);
        $bar = new Set(['red', 'green']);

        $diff = $foo->withDifference($bar);

        $this->assertSame(['blue'], $diff->toArray());

        $diff = $bar->withDifference($foo);

        $this->assertSame([], $diff->toArray());
    }

    public function testIntersection()
    {
        $foo = new Set(['red', 'green', 'blue']);
        $bar = new Set(['red', 'green']);

        $diff = $foo->withIntersection($bar);

        $this->assertSame(['red', 'green'], $diff->toArray());

        $diff = $bar->withIntersection($foo);

        $this->assertSame(['red', 'green'], $diff->toArray());
    }

    public function testUnion()
    {
        $foo = new Set(['red', 'green', 'blue']);
        $bar = new Set(['red', 'green']);

        $diff = $foo->withUnion($bar);

        $this->assertSame(['red', 'green', 'blue'], $diff->toArray());

        $diff = $bar->withUnion($foo);

        $this->assertSame(['red', 'green', 'blue'], $diff->toArray());
    }
}
