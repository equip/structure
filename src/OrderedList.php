<?php

namespace Equip\Structure;

use Equip\Structure\Traits\CanStructure;

class OrderedList implements ListInterface
{
    use CanStructure;

    public function hasValue($value)
    {
        return in_array($value, $this->values, true);
    }

    public function withValues(array $values)
    {
        if ($this->values === $values) {
            return $this;
        }

        $this->assertValid($values);

        $copy = clone $this;
        $copy->values = $values;
        $copy->sortValues();

        return $copy;
    }

    public function withValue($value)
    {
        $this->assertValid([$value]);

        $copy = clone $this;
        $copy->values[] = $value;
        $copy->sortValues();

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
        $copy->sortValues();

        return $copy;
    }

    protected function sortValues()
    {
        sort($this->values, SORT_REGULAR);
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
