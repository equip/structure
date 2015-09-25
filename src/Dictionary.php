<?php

namespace Shadowhand\Destrukt;

use Shadowhand\Destrukt\Ability;

class Dictionary implements StructInterface
{
    use Ability\Similar;
    use Ability\Storage;

    public function validate(array $data)
    {
        if (array_keys($data) === array_keys(array_values($data))) {
            throw new \InvalidArgumentException(
                'Hash structures must be indexed by keys'
            );
        }
    }

    /**
     * Check if a given value is defined.
     *
     * @param  string $key
     * @return boolean
     */
    public function hasValue($key)
    {
        return array_key_exists($key, $this->data);
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
        if ($this->hasValue($key)) {
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
        if (!is_string($key)) {
            throw new \InvalidArgumentException(
                'Dictionary key must be a string'
            );
        }

        $copy = clone $this;
        $copy->data[$key] = $value;

        return $copy;
    }

    /**
     * Get a copy without a given key.
     *
     * @param  string $key
     * @return self
     */
    public function withoutValue($key)
    {
        $copy = clone $this;
        unset($copy->data[$key]);

        return $copy;
    }
}
