<?php

namespace Shadowhand\Destrukt;

use Shadowhand\Destrukt\Ability;

class Set implements StructInterface
{
    use Ability\Storage;
    use Ability\ValueStorage {
        withValue as private withAddedValue;
    }

    public function validate(array $data)
    {
        if (array_values($data) !== $data) {
            throw new \InvalidArgumentException(
                'Set structures cannot be indexed by keys'
            );
        }

        if (array_unique($data) !== $data) {
            throw new \InvalidArgumentException(
                'Set structures must contain only unique values'
            );
        }
    }

    /**
     * Get a copy with an new value.
     *
     * @throws \UnexpectedValueException if the value already exists
     * @param  mixed $value
     * @return self
     */
    public function withValue($value)
    {
        if ($this->hasValue($value)) {
            return $this;
        }

        return $this->withAddedValue($value);
    }
}
