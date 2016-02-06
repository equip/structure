<?php

namespace Destrukt\Traits;

trait CanValidate
{
    /**
     * @throws \Destrukt\StructureException
     *  If the array is not usable for this structure.
     *
     * @param array $values
     *
     * @return void
     */
    abstract protected function assertValid(array $values);
}
