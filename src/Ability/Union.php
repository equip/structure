<?php

namespace Destrukt\Ability;

use Destrukt\StructInterface;

trait Union
{
    use Comparison;

    /**
     * Get a copy with values unioned with current data.
     *
     * @param  StructInterface $target
     * @return self
     */
    public function withUnion(StructInterface $target)
    {
        $this->assertSimilar($target);

        return $this->withData($this->union($target->toArray()));
    }

    /**
     * Union given values with current values.
     *
     * @param  array $values
     * @return array
     */
    private function union(array $values)
    {
        return array_values(array_unique(array_merge($this->toArray(), $values)));
    }
}
