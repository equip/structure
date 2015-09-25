<?php

namespace Shadowhand\Destrukt\Ability;

use Shadowhand\Destrukt\StructInterface;

trait Comparison
{
    // StructInterface
    abstract public function toArray();

    // Storage
    abstract public function withData(array $data);

    // Similar
    abstract public function assertSimilar(StructInterface $target);
}
