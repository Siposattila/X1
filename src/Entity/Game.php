<?php

namespace App\Entity;

use App\Repository\GameRepository;
use App\Validator\Constraint\UniqueGameId;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Game extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[NotNull]
    #[NotBlank]
    #[UniqueGameId]
    #[Groups(["game-admin", "game-public"])]
    #[ORM\Column(nullable: true)]
    private ?string $gameId = null;

    #[Groups(["game-admin"])]
    #[ORM\Column(nullable: true)]
    private ?int $masterId = null;

    #[Groups(["game-admin"])]
    #[ORM\Column(nullable: true, options: ["comment" => "Played cards in a round. (Always changing)"])]
    private ?string $playedCards = null;

    #[Groups(["game-admin"])]
    #[ORM\Column(nullable: true, options: ["comment" => "Played amount of chips in a round. (Always changing)"])]
    private ?int $playedChips = null;

    #[Groups(["game-admin", "game-public"])]
    #[ORM\ManyToOne(targetEntity: Player::class)]
    #[ORM\JoinColumn(name: "master_id", nullable: true, referencedColumnName: "id")]
    private ?Player $master = null;

    #[Groups(["game-admin", "game-public"])]
    #[ORM\OneToMany(targetEntity: Player::class, mappedBy: "game")]
    private ?Collection $players = null;

    #[NotNull]
    #[NotBlank]
    #[Groups(["game-admin", "game-public"])]
    #[ORM\Column(nullable: true, options: ["comment" => "Status of the game. (0 - inactive, 1 - starting, 2 - active)"])]
    private ?int $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMasterId(): ?string
    {
        return $this->masterId;
    }

    public function setMasterId(?string $masterId): self
    {
        $this->masterId = $masterId;

        return $this;
    }

    public function getPlayers(): ?array
    {
        return $this->players->getValues();
    }

    public function getPlayedCards(): ?string
    {
        return $this->playedCards;
    }

    public function setPlayedCards(?string $playedCards): self
    {
        $this->playedCards = $playedCards;

        return $this;
    }

    public function getPlayedChips(): ?int
    {
        return $this->playedChips;
    }

    public function setPlayedChips(?int $playedChips): self
    {
        $this->playedChips = $playedChips;

        return $this;
    }

    public function getGameId(): ?string
    {
        return $this->gameId;
    }

    public function setGameId(?string $gameId): self
    {
        $this->gameId = $gameId;

        return $this;
    }

    public function getMaster(): ?Player
    {
        return $this->master;
    }

    public function setMaster(?Player $master): self
    {
        $this->master = $master;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
