<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class DiscardPile
 * @ORM\Entity
 * @ORM\Table(name="discard_pile")
 * @package AppBundle\Entity
 */
class DiscardPile extends Pile
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @JMS\Type("string")
     * @var string
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Card", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="discard_piles_cards",
     *      joinColumns={@ORM\JoinColumn(name="pile_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="card_id", referencedColumnName="id")}
     * )
     * @JMS\Type("ArrayCollection<AppBundle\Entity\Card>")
     * @var array
     */
    protected $cards;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
