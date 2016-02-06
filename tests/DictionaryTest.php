<?php

namespace Destrukt;

use PHPUnit_Framework_TestCase as TestCase;

class DictionaryTest extends TestCase
{
    /**
     * @var Dictionary
     */
    protected $struct;

    public function setUp()
    {
        $this->struct = new Dictionary([
            'one'   => 1,
            'two'   => 2,
            'three' => 3,
            'four'  => 4,
        ]);
    }

    public function testGetValue()
    {
        $this->assertSame(1, $this->struct->getValue('one'));
        $this->assertSame(2, $this->struct->getValue('two'));

        // Default value is null
        $this->assertNull($this->struct->getValue('fuzzy'));

        // Can also be specified
        $this->assertSame(false, $this->struct->getValue('fuzzy', false));
    }

    public function testHasValue()
    {
        $this->assertTrue($this->struct->hasValue('one'));
        $this->assertTrue($this->struct->hasValue('four'));
        $this->assertFalse($this->struct->hasValue('fuzzy'));

        // Null values can be checked
        $copy = $this->struct->withValue('wuzzy', null);
        $this->assertTrue($copy->hasValue('wuzzy'));
    }

    public function testWithValues()
    {
        $values = [
            'zero' => '0',
            'pi' => '3.1416',
        ];

        $copy = $this->struct->withValues($values);

        $this->assertNotSame($this->struct, $copy);
        $this->assertSame($values, $copy->toArray());

        // Setting the same values should not copy
        $another = $copy->withValues($values);
        $this->assertSame($copy, $another);
    }

    public function testWithValuesInvalid()
    {
        $this->setExpectedException(ValidationException::class);

        $copy = $this->struct->withValues([1, 2, 3]);
    }

    public function testWithValue()
    {
        $this->assertArrayNotHasKey('five', $this->struct);

        $copy = $this->struct->withValue('five', 5);

        $this->assertNotSame($this->struct, $copy);
        $this->assertArrayHasKey('five', $copy);

        // Setting the same values should not copy
        $another = $copy->withValue('five', 5);
        $this->assertSame($copy, $another);
    }

    public function testWithoutValue()
    {
        $this->assertArrayHasKey('one', $this->struct);

        $copy = $this->struct->withoutValue('one');

        $this->assertNotSame($this->struct, $copy);
        $this->assertArrayNotHasKey('one', $copy);

        // Removing the a non-exisistant value should not copy
        $another = $copy->withoutValue('one');
        $this->assertSame($copy, $another);
    }
}
