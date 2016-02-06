<?php

namespace Destrukt;

use Destrukt\Traits\CanStructure;

class UnorderedList implements ListInterface
{
    use CanStructure;

    public function hasValue($value)
    {
        return in_array($value, $this->values, true);
    }

    public function withValues(array $values)
    {
        $this->assertValid($values);

        if ($this->values === $values) {
            return $this;
        }

        $copy = clone $this;
        $copy->values = $values;

        return $copy;
    }

    public function withValue($value)
    {
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

    protected function assertValid(array $values)
    {
        if (empty($values)) {
            return;
        }

        if ($values !== array_values($values)) {
            throw ValidationException::invalid(
                'List structures cannot have distinct keys'
            );
        }
    }
}
