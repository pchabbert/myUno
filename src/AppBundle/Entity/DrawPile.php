<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class DrawPile
 * @ORM\Entity
 * @ORM\Table(name="draw_pile")
 * @package AppBundle\Entity
 */
class DrawPile extends Pile
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
     * @ORM\ManyToMany(targetEntity="Card", cascade={"persist", "remove"}, fetch="EAGER")
     * @ORM\JoinTable(name="draw_piles_cards",
     *      joinColumns={@ORM\JoinColumn(name="pile_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="card_id", referencedColumnName="id")}
     * )
     * @JMS\Type("ArrayCollection<AppBundle\Entity\Card>")
     * @var ArrayCollection
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
