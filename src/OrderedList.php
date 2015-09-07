<?php

namespace Shadowhand\Destrukt;

use Shadowhand\Destrukt\Ability;

class OrderedList implements StructInterface
{
    use Ability\Storage;
    use Ability\ValueStorage;

    /**
     * @var callable
     */
    private $sorter = 'sort';

    public function validate(array $data)
    {
        if (array_values($data) !== $data) {
            throw new \InvalidArgumentException(
                'List structures cannot be indexed by keys'
            );
        }
    }

    public function getData()
    {
        // Hack to work around call_user_func being unable to pass by reference.
        // This is the offically recommended solution from http://php.net/call_user_func
        call_user_func_array($this->sorter, array(&$this->data));

        return $this->data;
    }

    /**
     * Get a copy with a different sorting method.
     *
     * @param  callable $sorter
     * @return self
     */
    public function withSorter(callable $sorter)
    {
        if ($this->sorter === $sorter) {
            return $this;
        }

        $copy = clone $this;
        $copy->sorter = $sorter;

        return $copy;
    }
}
