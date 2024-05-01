<?php

namespace App\Seriazable;

class SerializableObject implements \JsonSerializable
{

    private $serializable;

    public function __construct($serializable)
    {
        $this->serializable = $serializable;
    }

    public function jsonSerialize()
    {
        return [
            'serialized' => $this->serializable
        ];
    }

}

?>