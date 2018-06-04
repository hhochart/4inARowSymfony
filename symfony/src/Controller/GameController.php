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
        $player1 = $this->getUser();
        $player2 = $entityManager->getRepository(Player::class)->findOneBy(['email' => $request->get('email')]);

        $game = $entityManager->getRepository(Game::class)->findByPlayers($player1, $player2);
        if (empty($game)) {
            $this->createGame($player1, $player2, $entityManager);
        }

        return [
            'game' => $game,
            'player1' => $player1,
            'player2' => $player2
        ];
    }

    private function createGame(Player $player1, Player $player2, EntityManagerInterface $entityManager)
    {
        $g = new Game();
        $g->setGrid($this->getGameTemplate());
        $g->setPlayer1($player1);

        $g->setPlayer2($player2);
        $g->setPlayerTurn($this->getUser());
        $entityManager->persist($g);
        $entityManager->flush();
        $this->addFlash('notice', 'The game has just been created !');
        $this->redirectToRoute('game', ['gameId' => $g->getId()]);
    }

    private function getGameTemplate () {
        return [
          0 => [1 => '0', 2 => '0', 3 => '0', 4 => '0', 5 => '0', 6 => '0', 7 => '0',],
          1 => [1 => '0', 2 => '0', 3 => '0', 4 => '0', 5 => '0', 6 => '0', 7 => '0',],
          2 => [1 => '0', 2 => '0', 3 => '0', 4 => '0', 5 => '0', 6 => '0', 7 => '0',],
          3 => [1 => '0', 2 => '0', 3 => '0', 4 => '0', 5 => '0', 6 => '0', 7 => '0',],
          4 => [1 => '0', 2 => '0', 3 => '0', 4 => '0', 5 => '0', 6 => '0', 7 => '0',],
          5 => [1 => '0', 2 => '0', 3 => '0', 4 => '0', 5 => '0', 6 => '0', 7 => '0',],
        ];
    }


}
