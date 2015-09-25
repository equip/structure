<?php

namespace Shadowhand\Destrukt;

use Shadowhand\Destrukt\Ability;

class Set implements StructInterface
{
    use Ability\Similar;
    use Ability\Storage {
        replaceData as private replaceDataOriginal;
    }
    use Ability\ValueStorage {
        withValue as private withAddedValue;
    }

    /**
     * Replace existing data with fresh data.
     *
     * Duplicates are removed before replace.
     *
     * @param array $data
     * @return void
     */
    private function replaceData(array $data)
    {
        $this->replaceDataOriginal(array_unique($data));
    }

    public function validate(array $data)
    {
        if (array_values($data) !== $data) {
            throw new \InvalidArgumentException(
                'Set structures cannot be indexed by keys'
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
