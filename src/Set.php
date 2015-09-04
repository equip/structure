<?php

namespace Shadowhand\Destrukt;

class Set extends UnorderedList
{
    public function validate(array $data)
    {
        parent::validate($data);

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

        return parent::withValue($value);
    }
}
