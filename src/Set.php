<?php

namespace Shadowhand\Destrukt;

class Set implements StructInterface
{
    use Storage;

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
     * Check if a value exists.
     *
     * @param  mixed $value
     * @return boolean
     */
    public function hasValue($value)
    {
        return in_array($value, $this->toArray(), true);
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
            throw new \UnexpectedValueException(
                'Set already contains the given value'
            );
        }

        $copy = clone $this;
        $copy->data[] = $value;

        return $copy;
    }
}
