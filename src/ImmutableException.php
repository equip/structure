<?php

namespace Equip\Structure;

use RuntimeException;

class ImmutableException extends RuntimeException
{
    /**
     * @param string $class
     *
     * @return static
     */
    public static function cannotModify($class)
    {
        return new static(sprintf(
            'Cannot modify immutable class `%s` using array methods',
            $class
        ));
    }
}
