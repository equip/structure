<?php

namespace Destrukt\Ability;

use Destrukt\StructInterface;

trait Comparison
{
    // StructInterface
    abstract public function toArray();

    // Storage
    abstract public function withData(array $data);

    // Similar
    abstract public function assertSimilar(StructInterface $target);
}
