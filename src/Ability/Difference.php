<?php

namespace Shadowhand\Destrukt\Ability;

use Shadowhand\Destrukt\StructInterface;

trait Difference
{
    use Comparison;

    /**
     * Diff given values with current values.
     *
     * @param  array $values
     * @return array
     */
    private function difference(array $values)
    {
        return array_values(array_diff($this->toArray(), $values));
    }

    /**
     * Get a copy with values that are different than current data.
     *
     * @param  StructInterface $target
     * @return self
     */
    public function withDifference(StructInterface $target)
    {
        $this->assertSimilar($target);

        return $this->withData($this->difference($target->toArray()));
    }
}
