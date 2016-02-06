<?php

namespace Destrukt;

use Destrukt\Traits\CanStructure;

class Set implements SetInterface
{
    use CanStructure;

    public function hasValue($value)
    {
        return in_array($value, $this->values, true);
    }

    public function withValues(array $values)
    {
        $this->assertValid($values);

        $copy = clone $this;
        $copy->values = array_unique($values, SORT_REGULAR);

        return $copy;
    }

    public function withValue($value)
    {
        if ($this->hasValue($value)) {
            return $this;
        }

        $this->assertValid([$value]);

        $copy = clone $this;
        $copy->values[] = $value;

        return $copy;
    }

    public function withoutValue($value)
    {
        $key = array_search($value, $this->values, true);

        if ($key === false) {
            return $this;
        }

        $copy = clone $this;
        unset($copy->values[$key]);

        return $copy;
    }

    public function withValueAfter($value, $search)
    {
        if ($this->hasValue($value)) {
            return $this;
        }

        $this->assertValid([$value]);

        $copy = clone $this;

        $key = array_search($search, $this->values);
        if ($key === false) {
            array_push($copy->values, $value);
        } else {
            array_splice($copy->values, $key + 1, 0, $value);
        }

        return $copy;
    }

    public function withValueBefore($value, $search)
    {
        if ($this->hasValue($value)) {
            return $this;
        }

        $this->assertValid([$value]);

        $copy = clone $this;

        $key = array_search($search, $this->values);
        if ($key === false) {
            array_unshift($copy->values, $value);
        } else {
            array_splice($copy->values, $key, 0, $value);
        }

        return $copy;
    }

    protected function assertValid(array $values)
    {
        if (empty($values)) {
            return;
        }

        if ($values !== array_values($values)) {
            throw ValidationException::invalid(
                'Set structures cannot have distinct keys'
            );
        }
    }
}
