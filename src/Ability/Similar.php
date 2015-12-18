<?php

namespace Destrukt\Ability;

use Destrukt\StructInterface;

trait Similar
{
    // StructInterface
    public function isSimilar(StructInterface $target)
    {
        return ($target instanceof $this);
    }

    /**
     * Assert that the target is the same structure.
     *
     * @throws \InvalidArgumentException if the structure is not the same type
     * @param  StructInterface $target
     * @return void
     */
    public function assertSimilar(StructInterface $target)
    {
        if (!$this->isSimilar($target)) {
            throw new \InvalidArgumentException(sprintf(
                'Structure %s is not the same type as %s',
                get_class($target),
                get_class($this)
            ));
        }
    }
}
