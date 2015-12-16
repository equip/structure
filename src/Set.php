<?php

namespace Shadowhand\Destrukt;

use Shadowhand\Destrukt\Ability;

class Set implements StructInterface
{
    use Ability\Difference;
    use Ability\Intersection;
    use Ability\Similar;
    use Ability\Storage {
        replaceData as private replaceDataOriginal;
    }
    use Ability\Union;
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

    public function withValue($value)
    {
        if ($this->hasValue($value)) {
            return $this;
        }

        return $this->withAddedValue($value);
    }

    /**
     * Get a copy with a new value after another.
     *
     * If the search value does not exist, the value will be appended.
     *
     * @param  mixed $value
     * @param  mixed $search
     * @return static
     */
    public function withValueAfter($value, $search)
    {
        if ($this->hasValue($value)) {
            return $this;
        }

        $copy = clone $this;

        $key = array_search($search, $this->data);
        if (false === $key) {
            array_push($copy->data, $value);
        } else {
            array_splice($copy->data, $key + 1, 0, $value);
        }

        return $copy;
    }

    /**
     * Get a copy with a new value before another.
     *
     * If the search value does not exist, the value will be prepended.
     *
     * @param  mixed $value
     * @param  mixed $search
     * @return static
     */
    public function withValueBefore($value, $search)
    {
        if ($this->hasValue($value)) {
            return $this;
        }

        $copy = clone $this;

        $key = array_search($search, $this->data);
        if (false === $key) {
            array_unshift($copy->data, $value);
        } else {
            array_splice($copy->data, $key, 0, $value);
        }

        return $copy;
    }
}
