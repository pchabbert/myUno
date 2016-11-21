<?php

namespace AppBundle\Entity;

final class NumberCard extends Card
{
    public $number;
    public $color;

    /**
     * BonusCard constructor.
     */
    public function __construct($color, $number) {
        $this->color = $color;
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }
}
