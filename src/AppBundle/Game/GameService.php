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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

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

        // Create all cards
        // NumberCards
        $drawPile = new DrawPile();

        for ($i = 0; $i <= 9; $i++) {
            foreach ($colors as $color) {
                if ($i != 0) {
                    $drawPile->addCard(new NumberCard($color, $i));
                }
                $drawPile->addCard(new NumberCard($color, $i));
            }
        }

        // BonusCards

        // @TODO : bonus card in $cards
        $drawPile->addCard(new BonusCard());

//        $drawPile->shuffle();

        $game->setDrawPile($drawPile);
        $game->setDiscardPile($discardPile = new DiscardPile());

        $game->setNew(false);

        $this->em->persist($drawPile);
        $this->em->persist($discardPile);
        $this->em->persist($game);
        $this->em->flush();

        return $game;
    }

    public function start(Game $game)
    {
        $players = $game->getPlayers();
        $drawPile = $game->getDrawPile();

//        dump($players);
//        dump($game, $drawPile);

//        foreach ($players as $player) {
//            while (count($player->getHand()) <= 7) {
//                $card = $drawPile->first();
//                $player->getHand()->add($card);
//                $drawPile->remove($card);
//            }
//        }

        $this->em->persist($game);
        $this->em->flush();
    }
}