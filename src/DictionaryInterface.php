<?php

namespace Destrukt;

interface DictionaryInterface extends StructureInterface
{
    /**
     * Get a defined value or the default if the value is undefined.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function getValue($key, $default = null);

    /**
     * Check if the given value is defined.
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasValue($key);

    /**
     * Get a copy of the current dictionary with different data.
     *
     * @return static
     */
    public function withValues(array $values);

    /**
     * Get a copy that includes this key and value.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return static
     */
    public function withValue($key, $value);

    /**
     * Get a copy without the given key.
     *
     * @param string $key
     *
     * @return static
     */
    public function withoutValue($key);
}
