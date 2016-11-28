<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 21/11/16
 * Time: 14:22
 */

namespace AppBundle\Game;

use AppBundle\Entity\BonusCard;
use AppBundle\Entity\Card;
use AppBundle\Entity\DiscardPile;
use AppBundle\Entity\DrawPile;
use AppBundle\Entity\Game;
use AppBundle\Entity\NumberCard;
use AppBundle\Entity\Player;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use PhpSpec\Exception\Exception;

class GameService
{
    private $em;

    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    /**
     * Initialize a new game
     *
     * @return Game
     */
    public function initializeGame()
    {
        $game = new Game();
        $colors = [
            Card::COLOR_BLUE,
            Card::COLOR_GREEN,
            Card::COLOR_RED,
            Card::COLOR_YELLOW
        ];

        $bonuses = [
            Card::BONUS_REVERSE,
            Card::BONUS_SKIP,
            Card::BONUS_PLUS2,
        ];

        $drawPile = new DrawPile();

        // Create all cards
        // NumberCards
        for ($i = 0; $i <= 9; $i++) {
            foreach ($colors as $color) {
                if ($i != 0) {
                    $drawPile->addCard(new NumberCard($color, $i));
                }
                $drawPile->addCard(new NumberCard($color, $i));
            }
        }

        // BonusCards
        for ($i = 0; $i < 2; $i++) {
            foreach ($bonuses as $bonus) {
                $drawPile->addCard(new BonusCard($bonus));
            }
        }

        $drawPile->shuffle();

        $this->em->persist($drawPile);

        $game->setDrawPile($drawPile);
        $game->setDiscardPile($discardPile = new DiscardPile());

        $this->em->persist($discardPile);
        $this->em->persist($game);
        $this->em->flush();

        return $game;
    }

    public function start(Game $game)
    {
        $players = $game->getPlayers();
        $drawPile = $game->getDrawPile();

        // Distribute cards to players
        foreach ($players as $player) {
            $hand = $player->getHand();
            while ($hand->count() < 7) {
                $card = $drawPile->getCards()->first();
                $hand->add($card);
                $drawPile->removeCard($card);
            }
        }

        // Put the first card of DrawPile in DiscardPile
        $card = $drawPile->getCards()->first();
        $game->getDiscardPile()->getCards()->add($card);
        $drawPile->removeCard($card);

        // Game is started
        $game->setNew(false);

        $this->em->persist($game);
        $this->em->flush();
    }

    public function addPlayer(Game $game, Player $player)
    {
        // Game is new ? and Player not already in game ?
        if (!$game->isNew() && !$game->getPlayers()->contains($player)) {
            throw new \Exception('Game already started.');
        }
        // Player already in game ?
        if ($player->getGame() && $player->getGame() != $game) {
            throw new Exception('You are already in a game. Please use "Recover game" link.');
        }

        $player->getHand()->clear();
        $game->addPlayer($player);
        $player->setGame($game);

        $this->em->persist($player);
        $this->em->persist($game);
        $this->em->flush();

        return $game;
    }

    public function play(Game $game, Player $player, Card $card)
    {

    }
}