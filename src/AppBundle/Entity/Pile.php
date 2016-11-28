<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 20/11/16
 * Time: 12:50
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Pile
 * @ORM\MappedSuperclass
 * @package AppBundle\Entity
 */
abstract class Pile
{
    public function __construct()
    {
        $this->cards = new ArrayCollection();
    }

    public function shuffle()
    {
        if (is_array($this->cards) && !empty($this->cards)) {
            shuffle($this->cards);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * @param ArrayCollection $cards
     */
    public function setCards($cards)
    {
        $this->cards = $cards;
    }

    /**
     * @param Card $card
     */
    public function addCard(Card $card)
    {
        $this->cards[] = $card;
    }
}