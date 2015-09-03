<?php

namespace Shadowhand\Destrukt;

class HashStruct implements StructInterface
{
    use Storage;

    public function validate(array $data)
    {
        if (array_keys($data) === array_keys(array_values($data))) {
            throw new \InvalidArgumentException(
                'Hash structures must be indexed by keys'
            );
        }
    }

    /**
     * Get a value from the hash.
     *
     * If the value does not exist, the default will be returned.
     *
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    public function getValue($key, $default = null)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        return $default;
    }

    /**
     * Get a copy with an new value.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return self
     */
    public function withValue($key, $value)
    {
        $copy = clone $this;
        $copy->data[$key] = $value;

        return $copy;
    }
}
