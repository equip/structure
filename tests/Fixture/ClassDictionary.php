<?php

namespace Destrukt\Fixture;

use Destrukt\Dictionary;

class ClassDictionary extends Dictionary
{
    public function validate(array $data)
    {
        parent::validate($data);

        foreach ($data as $class) {
            if (!class_exists($class)) {
                throw new \InvalidArgumentException(
                    'Cannot add non-class value to ClassDictionary'
                );
            }
        }
    }
}
