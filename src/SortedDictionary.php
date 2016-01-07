<?php

namespace Destrukt;

use Destrukt\Ability;

class SortedDictionary implements StructInterface
{
    use Ability\HashStorage;
    use Ability\Similar;
    use Ability\SortedStorage;

    /**
     * @var callable
     */
    protected $sorter = 'asort';

    public function validate(array $data)
    {
        if (!empty($data) && array_keys($data) === array_keys(array_values($data))) {
            throw new \InvalidArgumentException(
                'Dictionary must be indexed by keys'
            );
        }
    }
}
