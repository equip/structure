<?php

namespace Equip\Structure;

use PHPUnit_Framework_TestCase as TestCase;

class OrderedListTest extends TestCase
{
    /**
     * @var OrderedList
     */
    private $struct;

    public function setUp()
    {
        $this->struct = new OrderedList([
            'red',
            'green',
            'blue',
            'black',
            'white',
            'green', // duplicate
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

        // If the values are exactly the same, nothing changes
        $another = $copy->withValues($values);
        $this->assertSame($copy, $another);
    }

    public function testWithValuesNotUnique()
    {
        $values = [
            'ant',
            'bee',
            'bee',
        ];

        $copy = $this->struct->withValues($values);

        $this->assertSame($values, $copy->toArray());
        $this->assertNotSame(array_unique($values), $copy->toArray());
    }

    public function testWithValuesSort()
    {
        $values = [
            'orange',
            'apple',
            'banana',
        ];

        $copy = $this->struct->withValues($values);

        $this->assertNotSame($values, $copy->toArray());

        sort($values);
        $this->assertSame($values, $copy->toArray());
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

        // If the value already exists, it is still appended
        $another = $copy->withValue('butterfly');
        $this->assertNotSame($copy, $another);
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
}
