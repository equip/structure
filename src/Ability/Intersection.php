<?php

namespace Destrukt\Ability;

use Destrukt\StructInterface;

trait Intersection
{
    use Comparison;

    /**
     * Get a copy with values intersected with current data.
     *
     * @param  StructInterface $target
     * @return self
     */
    public function withIntersection(StructInterface $target)
    {
        $this->assertSimilar($target);

        return $this->withData($this->intersect($target->toArray()));
    }

    /**
     * Intersect given values with current values.
     *
     * @param  array $values
     * @return array
     */
    private function intersect(array $values)
    {
        return array_intersect($this->toArray(), $values);
    }
}
