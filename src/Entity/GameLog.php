<?php

namespace App\Entity;

use App\Repository\GameLogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameLogRepository::class)]
#[ORM\HasLifecycleCallbacks]
class GameLog extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $gameId = null;

    #[ORM\ManyToOne(targetEntity: Game::class)]
    #[ORM\JoinColumn(name: "game_id", nullable: true, referencedColumnName: "id")]
    private ?Game $game = null;

    #[ORM\Column(nullable: true)]
    private ?int $cardId = null;

    #[ORM\ManyToOne(targetEntity: Card::class)]
    #[ORM\JoinColumn(name: "card_id", nullable: true, referencedColumnName: "id")]
    private ?Card $card = null;

    #[ORM\Column(nullable: true)]
    private ?int $playerId = null;

    #[ORM\ManyToOne(targetEntity: Player::class)]
    #[ORM\JoinColumn(name: "player_id", nullable: true, referencedColumnName: "id")]
    private ?Player $player = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameId(): ?int
    {
        return $this->gameId;
    }

    public function setGameId(?int $gameId): self
    {
        $this->gameId = $gameId;

        return $this;
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

    public function getCardId(): ?int
    {
        return $this->cardId;
    }

    public function setCardId(?int $cardId): self
    {
        $this->cardId = $cardId;

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

    public function getPlayerId(): ?int
    {
        return $this->playerId;
    }

    public function setPlayerId(?int $playerId): self
    {
        $this->playerId = $playerId;

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
}
