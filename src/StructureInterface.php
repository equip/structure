<?php

namespace Destrukt;

interface StructureInterface extends
    \ArrayAccess,
    \Countable,
    \Iterator,
    \JsonSerializable,
    \Serializable
{
    /**
     * Check if given structure is the same as this structure.
     *
     * @return boolean
     */
    public function isSimilar(StructureInterface $target);

    /**
     * Get an array copy of the current structure.
     *
     * @return array
     */
    public function toArray();
}
