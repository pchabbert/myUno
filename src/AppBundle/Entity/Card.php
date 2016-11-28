<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 19/11/16
 * Time: 17:50
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"card" = "Card", "number" = "NumberCard", "bonus" = "BonusCard"})
 * @JMS\Discriminator(field="class", map = {"bonus": "AppBundle\Entity\BonusCard", "number": "AppBundle\Entity\NumberCard"})
 */
class Card
{
    const COLOR_RED = 'red';
    const COLOR_YELLOW = 'yellow';
    const COLOR_BLUE = 'blue';
    const COLOR_GREEN = 'green';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @JMS\Type("integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $image;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
}