<?php

namespace Equip\Structure;

use PHPUnit_Framework_TestCase as TestCase;

class ArrayRecursionTest extends TestCase
{
    public function testToArray()
    {
        $books_by_lee = [
            'To Kill a Mockingbird',
            'Go Set a Watchman',
        ];

        $books_by_wilder = [
            'Little House in the Big Woods',
            'Little House on the Prairie',
        ];

        $books = new Dictionary([
            'Harper Lee' => new OrderedList($books_by_lee),
            'Laura Ingles Wilder' => new OrderedList($books_by_wilder),
        ]);

        $expect = [
            'Harper Lee' => $books_by_lee,
            'Laura Ingles Wilder' => $books_by_wilder,
        ];

        $this->assertSame($expect, $books->toArray());
    }
}
