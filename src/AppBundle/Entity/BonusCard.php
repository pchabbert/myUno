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
     * @JMS\Type("string")
     */
//    public $type = 'bonus';


}
