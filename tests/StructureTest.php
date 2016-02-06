<?php

namespace Destrukt;

use ArrayAccess;
use Countable;
use Destrukt\ImmutableException;
use Exception;
use JsonSerializable;
use Iterator;
use PHPUnit_Framework_TestCase as TestCase;
use Serializable;

class StructureTest extends TestCase
{
    public function dataStructures()
    {
        return [
            [
                Dictionary::class,
                [
                    'foo' => 'thing',
                    'bar' => 'widget',
                ],
                2,
            ],
            [
                Set::class,
                [
                    'red',
                    'green',
                    'blue',
                ],
                3,
            ],
            [
                OrderedList::class,
                [
                    'ant',
                    'bee',
                    'butterfly',
                    'caterpiller',
                    'fly',
                ],
                5,
            ],
        ];
    }

    /**
     * @dataProvider dataStructures
     */
    public function testStructure($class, $values, $count)
    {
        $struct = new $class($values);

        $this->assertStructure($struct);
        $this->assertArrayAccess($struct, $values);
        $this->assertArrayConversion($struct, $values);
        $this->assertComparison($struct, $class);
        $this->assertCount($count, $struct);
        $this->assertCountEmpty($struct);
        $this->assertIteration($struct);
        $this->assertSerialization($struct);
        $this->assertJsonSerialization($struct);
    }

    private function assertStructure($struct)
    {
        $this->assertInstanceOf(StructureInterface::class, $struct);
    }

    private function assertArrayAccess($struct, array $values)
    {
        $this->assertInstanceOf(ArrayAccess::class, $struct);

        $key = key($values);
        $this->assertTrue(isset($struct[$key]));
        $this->assertSame($struct[$key], $values[$key]);

        // We cannot use setExpectedException() for the following tests because
        // the thrown exception aborts the rest of the assertions.

        try {
            $struct[$values] = false;
            $this->fail('ImmutableException was not thrown by set');
        } catch (Exception $e) {
            $this->assertInstanceOf(ImmutableException::class, $e);
        }

        try {
            unset($struct[$key]);
            $this->fail('ImmutableException was not thrown by unset');
        } catch (Exception $e) {
            $this->assertInstanceOf(ImmutableException::class, $e);
        }
    }

    private function assertArrayConversion($struct, $values)
    {
        $this->assertSame($values, $struct->toArray());
    }

    private function assertComparison($struct, $class)
    {
        $this->assertTrue($struct->isSimilar(new $class));
        $this->assertFalse($struct->isSimilar($this->getMock(StructureInterface::class)));
    }

    private function assertCountEmpty($struct)
    {
        $struct = $struct->withValues([]);
        $this->assertCount(0, $struct);
    }

    private function assertIteration($struct)
    {
        $this->assertInstanceOf(Iterator::class, $struct);

        $values = \iterator_to_array($struct);
        $this->assertSame($values, $struct->toArray());
    }

    private function assertSerialization($struct)
    {
        $this->assertInstanceOf(Serializable::class, $struct);

        $copy = unserialize(serialize($struct));
        $this->assertSame($struct->toArray(), $copy->toArray());
    }

    private function assertJsonSerialization($struct)
    {
        $this->assertInstanceOf(JsonSerializable::class, $struct);

        $json = json_encode($struct);
        $this->assertJson($json);

        $copy = json_decode($json, true);
        $this->assertSame($copy, $struct->toArray());
    }
}
