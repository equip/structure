<?php

namespace Shadowhand\Destrukt\Ability;

trait Storage
{
    /**
     * @var array
     */
    private $data = [];

    // StructInterface
    abstract public function validate(array $array);

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if ($data) {
            $this->validate($data);
            $this->data = $data;
        }
    }

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

        $this->validate($data);

        $copy = clone $this;
        $copy->data = $data;

        return $copy;
    }

    // StructInterface
    final public function toArray()
    {
        return $this->getData();
    }

    // Countable
    public function count()
    {
        return count($this->data);
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
        $data = unserialize($data);

        $this->validate($data);

        $this->data = $data;
    }
}
