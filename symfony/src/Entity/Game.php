<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Player;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 * @ApiResource()
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Player
     * @ORM\OneToOne(targetEntity="Player")
     */
    private $player1;

    /**
     * @var Player
     * @ORM\OneToOne(targetEntity="Player")
     */
    private $player2;

    /**
     * @ORM\Column(type="array", length=255)
     */
    private $grid;

    /**
     * @var Player
     * @ORM\OneToOne(targetEntity="Player")
     */
    private $playerTurn;

    /**
     * @ORM\Column(type="boolean", options={"default": false}, nullable=true)
     */
    private $isOver;

    /**
     * @var Player
     * @ORM\OneToOne(targetEntity="Player")
     */
    private $winner;

    public function getId()
    {
        return $this->id;
    }

    public function getPlayer1(): ?Player
    {
        return $this->player1;
    }

    public function setPlayer1(Player $player1): self
    {
        $this->player1 = $player1;

        return $this;
    }

    public function getPlayer2(): ?Player
    {
        return $this->player2;
    }

    public function setPlayer2(Player $player2): self
    {
        $this->player2 = $player2;

        return $this;
    }

    public function getGrid(): array
    {
        return $this->grid;
    }

    public function setGrid(array $grid): self
    {
        $this->grid = $grid;

        return $this;
    }

    public function getPlayerTurn(): ?Player
    {
        return $this->playerTurn;
    }

    public function setPlayerTurn(Player $playerTurn): self
    {
        $this->playerTurn = $playerTurn;

        return $this;
    }

    public function getIsOver(): ?bool
    {
        return $this->isOver;
    }

    public function setIsOver(bool $isOver): self
    {
        $this->isOver = $isOver;

        return $this;
    }

    public function getWinner(): ?Player
    {
        return $this->winner;
    }

    public function setWinner(Player $winner): self
    {
        $this->winner = $winner;

        return $this;
    }
}
