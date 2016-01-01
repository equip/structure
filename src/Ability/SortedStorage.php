<?php

namespace Destrukt\Ability;

use Destrukt\StructInterface;

trait SortedStorage
{
    use Storage {
        replaceData as replaceDataUsingStorage;
    }

    /**
     * Get a copy with a different sorting method.
     *
     * @param callable $sorter
     *
     * @return self
     */
    public function withSorter(callable $sorter)
    {
        if ($this->sorter === $sorter) {
            return $this;
        }

        $copy = clone $this;
        $copy->sorter = $sorter;
        $copy->replaceData($this->data);

        return $copy;
    }

    /**
     * Replace existing data with fresh data that is sorted
     *
     * @param array $data
     *
     * @return void
     */
    private function replaceData(array $data)
    {
        $this->replaceDataUsingStorage($data);

        // Hack to work around call_user_func being unable to pass by reference.
        // This is the offically recommended solution from http://php.net/call_user_func
        call_user_func_array($this->sorter, array(&$this->data));
    }
}
