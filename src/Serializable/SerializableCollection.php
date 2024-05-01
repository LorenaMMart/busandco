<?php

namespace App\Seriazable;

class SerializableCollection implements \JsonSerializable {

private $elements;

public function __construct(array $elements)
{
    $this->elements = $elements;
}

public function jsonSerialize()
{
    return $this->elements;
}

}

?>

