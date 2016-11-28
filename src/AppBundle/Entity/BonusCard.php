<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class BonusCard
 * @ORM\Entity
 * @package AppBundle\Entity
 */
class BonusCard extends Card
{
    /**
     * @ORM\Column(type="string")
     * @JMS\Type("string")
     */
    public $bonusType;

    public function __construct($bonusType) {
        $this->bonusType = $bonusType;
    }

    /**
     * @return mixed
     */
    public function getBonusType()
    {
        return $this->bonusType;
    }

    /**
     * @param mixed $bonusType
     */
    public function setBonusType($bonusType)
    {
        $this->bonusType = $bonusType;
    }
}
