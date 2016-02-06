<?php

namespace Equip\Structure;

interface SetInterface extends StructureInterface
{
    /**
     * Check if the given value exists.
     *
     * @param string $value
     *
     * @return bool
     */
    public function hasValue($value);

    /**
     * Get a copy with new values.
     *
     * @return static
     */
    public function withValues(array $values);

    /**
     * Get a copy with an added value.
     *
     * @param mixed $value
     *
     * @return static
     */
    public function withValue($value);

    /**
     * Get a copy with a new value after another.
     *
     * If the search value does not exist, the value will be appended.
     *
     * @param mixed $value
     * @param mixed $search
     *
     * @return static
     */
    public function withValueAfter($value, $search);

    /**
     * Get a copy with a new value before another.
     *
     * If the search value does not exist, the value will be prepended.
     *
     * @param mixed $value
     * @param mixed $search
     *
     * @return static
     */
    public function withValueBefore($value, $search);

    /**
     * Get a copy without a value.
     *
     * @param mixed $value
     *
     * @return static
     */
    public function withoutValue($value);
}
