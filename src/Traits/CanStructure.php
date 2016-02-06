<?php

namespace Destrukt\Traits;

trait CanStructure /* implements StructureInterface */
{
    use CanAccess;
    use CanArray;
    use CanCompare;
    use CanCount;
    use CanIterate;
    use CanSerialize;
    use CanSerializeJson;
    use CanValidate;

    /**
     * @var array
     */
    protected $values = [];

    public function __construct(array $values = [])
    {
        $this->assertValid($values);
        $this->values = $values;
    }
}
