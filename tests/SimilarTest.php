<?php

namespace Shadowhand\Test\Destrukt;

class SimilarTest extends \PHPUnit_Framework_TestCase
{
    public function dataSimilar()
    {
        $classes = [
            'Destrukt\Dictionary',
            'Destrukt\OrderedList',
            'Destrukt\Set',
            'Destrukt\UnorderedList',
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

        if ($similar) {
            $this->assertNull($primary->assertSimilar($secondary));
        } else {
            $this->setExpectedException('\InvalidArgumentException');
            $primary->assertSimilar($secondary);
        }
    }
}
