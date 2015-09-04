<?php

namespace Shadowhand\Destrukt\Ability;

trait ValueStorage
{
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
     * @param  mixed $value
     * @return self
     */
    public function withValue($value)
    {
        $copy = clone $this;
        $copy->data[] = $value;

        return $copy;
    }

    /**
     * Get a copy without a given value.
     *
     * @param  string $key
     * @return self
     */
    public function withoutValue($value)
    {
        $copy = clone $this;

        if (false !== ($key = array_search($value, $copy->data, true))) {
            unset($copy->data[$key]);
        }

        return $copy;
    }
}
