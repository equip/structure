<?php

namespace Shadowhand\Test\Destrukt;

use Shadowhand\Destrukt\Set;

abstract class StructTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Shadowhand\Destrukt\StructInterface
     */
    protected $struct;

    // Countable
    public function testCount()
    {
        $this->assertEquals(count($this->struct), $this->struct->count());
    }

    // Serializable
    public function testSerialize()
    {
        $rebuilt = unserialize(serialize($this->struct));

        $this->assertEquals($this->struct->toArray(), $rebuilt->toArray());
    }

    // JsonSerializable
    public function testJson()
    {
        $this->assertJson(json_encode($this->struct));
    }

    public function testIterator()
    {
        $this->assertInstanceOf('\Iterator', $this->struct);

        foreach ($this->struct as $key => $value) {
            // Nothing needs to be asserted, the foreach() is the test
        }

        $array = \iterator_to_array($this->struct);
        $this->assertSame($array, $this->struct->toArray());
    }
}
