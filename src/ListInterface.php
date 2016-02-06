<?php

namespace Destrukt;

interface ListInterface extends StructureInterface
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
     * Get a copy without a value.
     *
     * @param mixed $value
     *
     * @return static
     */
    public function withoutValue($value);
}
