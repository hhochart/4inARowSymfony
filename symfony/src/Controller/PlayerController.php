<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayerController extends Controller
{

    /**
     * @Route("/", name="player")
     * @Template("player/index.html.twig")
     * @param EntityManagerInterface $entityManager
     *
     * @return array
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $players = $entityManager->getRepository(Player::class)->findAllPlayers($this->getUser());
        $games = $entityManager->getRepository(Game::class)->findByPlayer($this->getUser());

        return [
            'controller_name' => 'PlayerController',
            'players' => $players,
            'games' => $games
        ];
    }
}
