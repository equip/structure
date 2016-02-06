<?php

namespace Equip\Structure;

use PHPUnit_Framework_TestCase as TestCase;

class SimilarTest extends TestCase
{
    public function dataSimilar()
    {
        $classes = [
            Dictionary::class,
            OrderedList::class,
            Set::class,
            UnorderedList::class,
        ];

        $matrix = [];
        foreach ($classes as $primary) {
            foreach ($classes as $secondary) {
                $matrix[] = [$primary === $secondary, new $primary, new $secondary];
            }
        }

        return $matrix;
    }

    /**
     * @dataProvider dataSimilar
     */
    public function testSimilar($similar, $primary, $secondary)
    {
        $this->assertSame($similar, $primary->isSimilar($secondary));
    }
}
