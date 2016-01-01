<?php

namespace Destrukt;

use Destrukt\Ability;

class Dictionary implements StructInterface
{
    use Ability\Similar;
    use Ability\Storage;
    use Ability\HashStorage;

    public function validate(array $data)
    {
        if (!empty($data) && array_keys($data) === array_keys(array_values($data))) {
            throw new \InvalidArgumentException(
                'Dictionary must be indexed by keys'
            );
        }
    }
}
