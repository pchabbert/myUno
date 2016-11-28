<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BonusCard;
use AppBundle\Entity\Card;
use AppBundle\Entity\Game;
use AppBundle\Entity\Player;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{
    /**
     * @Route("/lobby", name="lobby")
     */
    public function lobbyAction()
    {
        $em = $this->getDoctrine()->getManager();
        $games = $em->getRepository('AppBundle:Game')->findAll();

        return $this->render('default/lobby.html.twig', [
            'games' => $games,
        ]);
    }

    /**
     * @Route("/game/create", name="post_game_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postGameNewAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $gameService = $this->get('app.game_service');
            $game = $gameService->initializeGame();
            $player = $this->getUser();

            $game->setName($request->get('game_name'));
            $gameService->addPlayer($game, $player);

            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            return $this->redirectToRoute('get_game', ['id' => $game->getId()]);
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/game/{id}", name="get_game")
     * @Method("GET")
     * @param Request $request
     * @param Game $game
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getGameStateAction(Request $request, Game $game)
    {
        if (!$game->getPlayers()->contains($this->getUser())) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/game.html.twig', ['game' => $game]);
    }

    /**
     * @Route("/game/{id}/start", name="get_game_start")
     * @Method({"GET"})
     * @param Request $request
     * @param Game $game
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getGameStartAction(Request $request, Game $game)
    {
        $this->get('app.game_service')->start($game);

        return $this->redirectToRoute('get_game', ['id' => $game->getId()]);
    }

    /**
     * @Route("/game/{id}/play/{card_id}", name="play_card")
     * @Method({"GET"})
     * @param Request $request
     * @param Game $game
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getPlayCardAction(Request $request, Game $game, Card $card)
    {
        $this->get('app.game_service')->play($game, $this->getUser(), $card);

        return $this->redirectToRoute('get_game', ['id' => $game->getId()]);
    }

    /**
     * @Route("/game/{id}/join", name="game_join")
     * @Method("GET")
     * @param Request $request
     * @param Game $game
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function gameJoinAction(Request $request, Game $game)
    {
        $player = $this->getUser();

        try {
            $this->get('app.game_service')->addPlayer($game, $player);
        } catch (\Exception $e) {
            $request->getSession()->getFlashBag()
                ->add('error', $e->getMessage());
            return $this->redirectToRoute('lobby');
        }

        return $this->redirectToRoute('get_game', ['id' => $game->getId()]);
    }

    /**
     * @Route("/game/{id}/over", name="game_over")
     * @Method("GET")
     * @param Request $request
     * @param Game $game
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function gameOver(Request $request, Game $game)
    {
        $em = $this->getDoctrine()->getManager();

        foreach ($game->getPlayers() as $player) {
            $player->setGame();
            $player->getHand()->clear();

            $em->persist($player);
        }

        $em->remove($game->getDiscardPile());
        $em->remove($game->getDrawPile());
        $em->remove($game);
        $em->flush();

        return $this->redirectToRoute('lobby');
    }
}
