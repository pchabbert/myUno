<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Card;
use AppBundle\Entity\DiscardPile;
use AppBundle\Entity\DrawPile;
use AppBundle\Entity\NumberCard;
use AppBundle\Entity\Pile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use spec\AppBundle\Entity\DrawPileSpec;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $card = new NumberCard(Card::COLOR_BLUE, 1);

        return $this->render('default/index.html.twig', [ 'card' => $card]);
    }

    /**
     * @Route("/pile", name="pile")
     */
    public function pileAction(Request $request)
    {
        $draw = new DrawPile();

        for ($i = 1; $i <= 10; $i++) {
            $draw->addCard(new NumberCard(Card::COLOR_BLUE, $i));
        }

        $draw->shuffle();

        return $this->render('default/pile.html.twig', [
            'drawPile' => $draw,
            'discarPile' => new DiscardPile()
        ]);
    }
}
