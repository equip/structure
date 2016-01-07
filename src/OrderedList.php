<?php

namespace Destrukt;

use Destrukt\Ability;

class OrderedList implements StructInterface
{
    use Ability\Similar;
    use Ability\SortedStorage;
    use Ability\ValueStorage;

    /**
     * @var callable
     */
    protected $sorter = 'sort';

    public function validate(array $data)
    {
        if (array_values($data) !== $data) {
            throw new \InvalidArgumentException(
                'List structures cannot be indexed by keys'
            );
        }
    }
}
