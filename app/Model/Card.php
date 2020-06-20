<?php

namespace App\Model;

class Card
{
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $name;
    /**
     * @var integer
     */
    private $value;

    /**
     * Card constructor.
     * @param $type
     * @param $name
     * @param $value
     */
    public function __construct(string $type, string $name, int $value)
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function isAce()
    {
        return $this->value === 1;
    }

    public function __toString()
    {
        return sprintf("Type: %s , Name: %s", $this->type, $this->name);
    }
}