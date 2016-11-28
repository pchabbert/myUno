<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class DrawPile
 * @ORM\Entity
 * @package AppBundle\Entity
 */
class NumberCard extends Card
{
    /**
     * @ORM\Column(type="integer")
     * @JMS\Type("integer")
     */
    private $number;

    /**
     * @ORM\Column(type="string")
     * @JMS\Type("string")
     */
    private $color;

    /**
     * NumberCard constructor.
     */
    public function __construct($color, $number) {
        $this->color = $color;
        $this->number = $number;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return NumberCard
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return NumberCard
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }
}
