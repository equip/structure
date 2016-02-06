<?php

namespace Equip\Structure;

use Equip\Structure\Traits\CanStructure;

class Dictionary implements DictionaryInterface
{
    use CanStructure;

    public function getValue($key, $default = null)
    {
        if ($this->hasValue($key)) {
            return $this->values[$key];
        }

        return $default;
    }

    public function hasValue($key)
    {
        return array_key_exists($key, $this->values);
    }

    public function withValues(array $values)
    {
        if ($this->values === $values) {
            return $this;
        }

        $this->assertValid($values);

        $copy = clone $this;
        $copy->values = $values;

        return $copy;
    }

    public function withValue($key, $value)
    {
        if ($this->hasValue($key) && $this->getValue($key) === $value) {
            return $this;
        }

        $this->assertValid([$key => $value]);

        $copy = clone $this;
        $copy->values[$key] = $value;

        return $copy;
    }

    public function withoutValue($key)
    {
        if (!$this->hasValue($key)) {
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

        $keys = array_keys($values);
        $vals = array_values($values);

        if ($keys === array_keys($vals)) {
            throw ValidationException::invalid(
                'Dictionary values must have distinct keys'
            );
        }
    }
}
