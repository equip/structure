<?php

namespace Destrukt;

use Destrukt\Fixture\ClassDictionary;

class DictionaryTest extends StructTestCase
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

    // ArrayAccess
    public function testOffsetExists()
    {
        $this->assertTrue(isset($this->struct['one']));
        $this->assertFalse(isset($this->struct['five']));
    }

    // ArrayAccess
    public function testOffsetGet()
    {
        $this->assertSame(1, $this->struct['one']);
    }

    public function testReplace()
    {
        $dict = $this->struct;
        $copy = $dict->withData([
            'one'   => 'uno',
            'two'   => 'dos',
            'three' => 'tres',
            'four'  => 'quatro',
        ]);

        $this->assertEquals(1, $dict->getValue('one'));
        $this->assertEquals('uno', $copy->getValue('one'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testReplaceFailure()
    {
        $this->struct->withData([3, 2, 1]);
    }

    public function testExists()
    {
        $this->assertTrue($this->struct->hasValue('one'));
        $this->assertTrue($this->struct->hasValue('four'));
        $this->assertFalse($this->struct->hasValue('five'));
        $this->assertFalse($this->struct->hasValue('nil'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAppendValidationFailure()
    {
        $dict = new ClassDictionary([
            get_class($this)
        ]);
        $dict = $dict->withValue('foo');
    }

    public function testAppend()
    {
        $dict = $this->struct;
        $copy = $dict->withValue('five', 5);

        $this->assertEquals(4, count($dict));
        $this->assertEquals(5, count($copy));

        $this->assertEquals(null, $dict->getValue('five'));

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

    public function testRemoveKey()
    {
        $dict = $this->struct;
        $copy = $dict->withoutValue('one');

        $this->assertTrue($dict->hasValue('one'));
        $this->assertFalse($copy->hasValue('one'));
    }

    public function testClear()
    {
        $dict = $this->struct->withData([]);

        $this->assertSame([], $dict->toArray());
    }
}
