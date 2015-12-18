<?php

namespace Destrukt;

use Destrukt\Fixture\NumberSet;

class SetTest extends StructTestCase
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

        $copy = $this->struct->withData([
            $this,
            function () {
            }
        ]);
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

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAppendValidateFailure()
    {
        $set = new NumberSet([5]);
        $set = $set->withValue('foo');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAppendAfterValidateFailure()
    {
        $set = new NumberSet([5]);
        $set = $set->withValueAfter('foo', 5);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAppendBeforeValidateFailure()
    {
        $set = new NumberSet([5]);
        $set = $set->withValueBefore('foo', 5);
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

    public function testAppendAfter()
    {
        $set = new Set;

        $s1 = 1;
        $s2 = 2;
        $s3 = 3;
        $s4 = 4;

        $set = $set->withValue($s1);
        $this->assertSame([$s1], $set->toArray());

        $set = $set->withValueAfter($s2, $s1);
        $this->assertSame([$s1, $s2], $set->toArray());

        $set = $set->withValueAfter($s3, $s1);
        $this->assertSame([$s1, $s3, $s2], $set->toArray());

        // Nothing should change, s1 is already in the set
        $set = $set->withValueAfter($s1, $s3);
        $this->assertSame([$s1, $s3, $s2], $set->toArray());

        // Value does not exist, it should append
        $set = $set->withValueAfter($s4, 0);
        $this->assertSame([$s1, $s3, $s2, $s4], $set->toArray());
    }

    public function testAppendBefore()
    {
        $set = new Set;

        $s1 = 1;
        $s2 = 2;
        $s3 = 3;
        $s4 = 4;

        $set = $set->withValue($s1);
        $this->assertSame([$s1], $set->toArray());

        $set = $set->withValueBefore($s2, $s1);
        $this->assertSame([$s2, $s1], $set->toArray());

        $set = $set->withValueBefore($s3, $s1);
        $this->assertSame([$s2, $s3, $s1], $set->toArray());

        // Nothing should change, s1 is already in the set
        $set = $set->withValueBefore($s1, $s3);
        $this->assertSame([$s2, $s3, $s1], $set->toArray());

        // Value does not exist, it should prepend
        $set = $set->withValueBefore($s4, 0);
        $this->assertSame([$s4, $s2, $s3, $s1], $set->toArray());
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
