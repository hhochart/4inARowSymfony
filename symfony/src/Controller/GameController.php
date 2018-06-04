<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class GameController
 * @package App\Controller
 * @Route("game/")
 */
class GameController extends Controller
{
    /**
     * @Template("game/game.html.twig")
     * @Route("game", name="game")
     * @param EntityManagerInterface $entityManager
     *
     * @param Request $request
     *
     * @return array
     * @throws \Exception
     */
    public function game(EntityManagerInterface $entityManager, Request $request)
    {

        $g = new Game();
        $g->setGrid([]);
        $g->setPlayer1($this->getUser());

        $player2 = $entityManager->getRepository(Player::class)->findOneBy(['email' => $request->get('email')]);
        $g->setPlayer2($player2);
        $g->setPlayerTurn($this->getUser());
        if ($entityManager->contains($g)) {
            $this->redirectToRoute('player');
            throw new \Exception('This game already exists');
        } else {
            $entityManager->persist($g);
            $entityManager->flush();

            $this->addFlash('notice', 'The game has just been created !');
            $this->redirectToRoute('game', ['gameId' => $g->getId()]);
        }

    }

}
