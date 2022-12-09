<?php

namespace App\Entity;

use App\Repository\GameRepository;
use App\Validator\Constraint\UniqueGameId;
use Doctrine\ORM\Mapping as ORM;
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
    #[ORM\Column(nullable: true)]
    private ?string $gameId = null;

    #[ORM\Column]
    private ?int $masterId = null;

    #[ORM\OneToOne(targetEntity: Player::class)]
    #[ORM\JoinColumn(name: "master_id", nullable: true, referencedColumnName: "id")]
    private ?Player $master = null;

    #[NotNull]
    #[NotBlank]
    #[ORM\Column(nullable: true)]
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
