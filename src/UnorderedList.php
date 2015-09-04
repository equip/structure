<?php

namespace Shadowhand\Destrukt;

class UnorderedList implements StructInterface
{
    use Storage;

    public function validate(array $data)
    {
        if (array_values($data) !== $data) {
            throw new \InvalidArgumentException(
                'List structures cannot be indexed by keys'
            );
        }
    }

    /**
     * Get a copy with an new value.
     *
     * @param  mixed $value
     * @return self
     */
    public function withValue($value)
    {
        $copy = clone $this;
        $copy->data[] = $value;

        return $copy;
    }
}
