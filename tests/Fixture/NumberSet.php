<?php

namespace Destrukt\Fixture;

use Destrukt\Set;

class NumberSet extends Set
{
    public function validate(array $data)
    {
        parent::validate($data);

        foreach ($data as $value) {
            if (!is_numeric($value)) {
                throw new \InvalidArgumentException(
                    'Cannot add non-numeric value to NumberSet'
                );
            }
        }
    }
}
