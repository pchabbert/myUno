<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 21/11/16
 * Time: 14:24
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Game
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 * @ORM\Table(name="game")
 * @package AppBundle\Entity
 */
class Game
{
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
     * @JMS\Type("integer")
     * @var string
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="DrawPile", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="draw_pile_id", referencedColumnName="id")
     * @JMS\Type("AppBundle\Entity\DrawPile")
     * @var DrawPile
     */
    private $drawPile;

    /**
     * @ORM\OneToOne(targetEntity="DiscardPile", cascade={"all"})
     * @ORM\JoinColumn(name="discard_pile_id", referencedColumnName="id")
     * @JMS\Type("AppBundle\Entity\DiscardPile")
     * @var DiscardPile
     */
    private $discardPile;

    /**
     * @ORM\OneToMany(targetEntity="Player", mappedBy="game", cascade={"persist"})
     * @JMS\Type("ArrayCollection<AppBundle\Entity\Player>")
     * @var array
     */
    private $players;

    /**
     * @JMS\Type("boolean")
     * @var bool
     */
    private $new = true;

    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return DrawPile
     */
    public function getDrawPile()
    {
        return $this->drawPile;
    }

    /**
     * @param DrawPile $drawPile
     */
    public function setDrawPile(DrawPile $drawPile)
    {
        $this->drawPile = $drawPile;
    }

    /**
     * @return DiscardPile
     */
    public function getDiscardPile()
    {
        return $this->discardPile;
    }

    /**
     * @param DiscardPile $discardPile
     */
    public function setDiscardPile(DiscardPile $discardPile)
    {
        $this->discardPile = $discardPile;
    }

    /**
     * @param Player $player
     * @throws \Exception
     */
    public function addPlayer(Player $player)
    {
        if (count($this->players) < 4)
        {
            $this->players[] = $player;
        } else {
            throw new \Exception("Maximun player reach");
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @return boolean
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * @param boolean $new
     */
    public function setNew($new)
    {
        $this->new = $new;
    }

}