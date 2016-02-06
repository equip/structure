<?php

namespace Destrukt\Traits;

trait CanSerialize /* implements Serializable */
{
    use CanValidate;

    public function serialize()
    {
        return serialize($this->values);
    }

    public function unserialize($values)
    {
        $values = unserialize($values);
        $this->assertValid($values);
        $this->values = $values;
    }
}
