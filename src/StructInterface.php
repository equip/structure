<?php

namespace Shadowhand\Destrukt;

interface StructInterface extends
    \Countable,
    \JsonSerializable,
    \Serializable
{
    /**
     * Get an array copy of the current structure.
     *
     * @return array
     */
    public function toArray();

    /**
     * Validate an array for correct structure.
     *
     * @throws \InvalidArgumentException
     * @return void
     */
    public function validate(array $data);
}
