<?php

namespace Athene2Test\HydratorTest\Asset;

class ArraySerializableAsset
{
    /**
     * @var mixed
     */
    protected $id;

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

    public function populate(array $data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
    }

    public function getArrayCopy()
    {
        return ['id' => $this->id];
    }
}
