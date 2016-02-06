<?php

namespace Destrukt;

use PHPUnit_Framework_TestCase as TestCase;

class SetTest extends TestCase
{
    /**
     * @var Set
     */
    private $struct;

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

    public function testHasValue()
    {
        $this->assertTrue($this->struct->hasValue('red'));
        $this->assertTrue($this->struct->hasValue('black'));
        $this->assertFalse($this->struct->hasValue('yellow'));
    }

    public function testWithValues()
    {
        $values = [
            'ant',
            'fly',
        ];

        $copy = $this->struct->withValues($values);

        $this->assertNotSame($this->struct, $copy);
        $this->assertSame($values, $copy->toArray());
    }

    public function testWithValuesUnique()
    {
        $values = [
            'bee',
            'wasp',
            'hornet',
            'bee',
        ];

        $copy = $this->struct->withValues($values);

        $this->assertNotSame($this->struct, $copy);
        $this->assertSame(array_unique($values), $copy->toArray());
    }

    public function testWithValuesInvalid()
    {
        $this->setExpectedException(ValidationException::class);

        $copy = $this->struct->withValues([
            'color' => 'magenta',
        ]);
    }

    public function testWithValue()
    {
        $copy = $this->struct->withValue('butterfly');

        $this->assertNotSame($this->struct, $copy);
        $this->assertFalse($this->struct->hasValue('butterfly'));
        $this->assertTrue($copy->hasValue('butterfly'));

        // If the value already exists, nothing changes
        $same = $copy->withValue('butterfly');
        $this->assertSame($copy, $same);
    }

    public function testWithoutValue()
    {
        $copy = $this->struct->withoutValue('blue');

        $this->assertNotSame($this->struct, $copy);
        $this->assertTrue($this->struct->hasValue('blue'));
        $this->assertFalse($copy->hasValue('blue'));

        // If the value does not exist, nothing changes
        $same = $copy->withoutValue('blue');
        $this->assertSame($copy, $same);
    }

    public function testWithValueAfter()
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

    public function testWithValueBefore()
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
}
