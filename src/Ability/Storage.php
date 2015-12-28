<?php

namespace Destrukt\Ability;

use RuntimeException;

trait Storage
{
    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->replaceData($data);
        }
    }

    // StructInterface
    abstract public function validate(array $array);

    /**
     * @var array
     */
    private $data = [];

    /**
     * Get a copy of the stored data.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get a copy with new stored data.
     *
     * @param  array $data
     * @return self
     */
    public function withData(array $data)
    {
        if ($this->getData() === $data) {
            return $this;
        }

        $copy = clone $this;
        $copy->replaceData($data);

        return $copy;
    }

    // StructInterface
    final public function toArray()
    {
        return $this->getData();
    }

    // ArrayAccess
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    // ArrayAccess
    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    // ArrayAccess
    public function offsetSet($offset, $value)
    {
        throw $this->immutableException();
    }

    // ArrayAccess
    public function offsetUnset($offset)
    {
        throw $this->immutableException();
    }

    // Countable
    public function count()
    {
        return count($this->data);
    }

    // Iterator
    public function current()
    {
        return current($this->data);
    }

    // Iterator
    public function key()
    {
        return key($this->data);
    }

    // Iterator
    public function next()
    {
        next($this->data);
    }

    // Iterator
    public function rewind()
    {
        reset($this->data);
    }

    // Iterator
    public function valid()
    {
        $key = $this->key();
        return isset($this->data[$key]);

    }

    // JsonSerializable
    final public function jsonSerialize()
    {
        return $this->toArray();
    }

    // Serializable
    public function serialize()
    {
        return serialize($this->data);
    }

    // Serializable
    public function unserialize($data)
    {
        $this->replaceData(unserialize($data));
    }

    /**
     * Replace existing data with fresh data.
     *
     * @param array $data
     * @return void
     */
    private function replaceData(array $data)
    {
        $this->validate($data);
        $this->data = $data;
    }

    /**
     * @return RuntimeException
     */
    private function immutableException()
    {
        return new RuntimeException(sprintf(
            'Cannot modify immutable class `%s` using array access',
            get_class($this)
        ));
    }
}
