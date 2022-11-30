<?php

namespace App\Entity;

use App\Repository\GameLogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameLogRepository::class)]
class GameLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: Game::class)]
    #[ORM\JoinColumn(name: "game_id", nullable: true, referencedColumnName: "id")]
    private ?Game $game = null;

    #[ORM\OneToOne(targetEntity: Card::class)]
    #[ORM\JoinColumn(name: "card_id", nullable: true, referencedColumnName: "id")]
    private ?Card $card = null;

    #[ORM\OneToOne(targetEntity: Player::class)]
    #[ORM\JoinColumn(name: "player_id", nullable: true, referencedColumnName: "id")]
    private ?Player $player = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getCard(): ?Card
    {
        return $this->card;
    }

    public function setCard(?Player $card): self
    {
        $this->card = $card;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
