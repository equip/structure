<?php

namespace Destrukt;

class SortedDictionaryTest extends DictionaryTest
{
    public function setUp()
    {
        $this->struct = new SortedDictionary([
            'one'   => 1,
            'two'   => 2,
            'three' => 3,
            'four'  => 4,
        ]);
    }

    public function testSorting()
    {
        $values = $this->struct->toArray();

        asort($values);

        $this->assertSame($values, $this->struct->toArray());

        $copy = $this->struct->withSorter('ksort');

        ksort($values);

        $this->assertSame($values, $copy->toArray());
    }
}
