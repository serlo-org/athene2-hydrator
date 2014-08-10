<?php

namespace Athene2Test\HydratorTest\Asset;

class EntityAsset
{
    /**
     * @var mixed
     */
    public $id;

    /**
     * @param mixed $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
