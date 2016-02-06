<?php

namespace Equip\Structure;

class SortedDictionary extends Dictionary
{
    public function withValues(array $values)
    {
        return $this->sortChanged(
            parent::withValues($values)
        );
    }

    public function withValue($key, $value)
    {
        return $this->sortChanged(
            parent::withValue($key, $value)
        );
    }

    public function withoutValue($key)
    {
        return $this->sortChanged(
            parent::withoutValue($key)
        );
    }

    /**
     * Sorts values, respecting keys.
     *
     * @return void
     */
    protected function sortValues()
    {
        asort($this->values);
    }

    /**
     * Sorts the dictionary if it is not the same.
     *
     * @param SortedDictionary $copy
     *
     * @return SortedDictionary
     */
    private function sortChanged(SortedDictionary $copy)
    {
        if ($copy !== $this) {
            $copy->sortValues();
        }

        return $copy;
    }
}
