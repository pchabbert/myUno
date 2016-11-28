<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 19/11/16
 * Time: 17:50
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Player
 * @ORM\Entity
 * @ORM\Table(name="player")
 * @UniqueEntity(
 *     "name",
 *     message="This name already exists."
 * )
 * @package AppBundle\Entity
 */
class Player implements UserInterface , \Serializable
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
     * @ORM\Column(type="string", unique=true)
     * @JMS\Type("string")
     * @Assert\NotBlank()
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="players")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id", nullable=true)
     */
    private $game;

    /**
     * @JMS\Type("ArrayCollection<AppBundle\Entity\Card>")
     * @ORM\ManyToMany(targetEntity="Card", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="players_cards",
     *      joinColumns={@ORM\JoinColumn(name="player_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="card_id", referencedColumnName="id")}
     * )
     * @var array
     */
    private $hand;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hand = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set game
     *
     * @param \AppBundle\Entity\Game $game
     *
     * @return Player
     */
    public function setGame(Game $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \AppBundle\Entity\Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @return ArrayCollection
     */
    public function getHand()
    {
        return $this->hand;
    }

    /**
     * Add hand
     *
     * @param \AppBundle\Entity\Card $hand
     *
     * @return Player
     */
    public function addHand(Card $hand)
    {
        $this->hand[] = $hand;

        return $this;
    }

    /**
     * Remove hand
     *
     * @param \AppBundle\Entity\Card $hand
     */
    public function removeHand(Card $hand)
    {
        $this->hand->removeElement($hand);
    }

    /**
     * @param array $hand
     */
    public function setHand($hand)
    {
        $this->hand = $hand;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->name,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->name,
            $this->password
            ) = unserialize($serialized);
    }

    /**
     * Returns the roles granted to the user.
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return array('ROLE_PLAYER');
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->name;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials() { }
}
