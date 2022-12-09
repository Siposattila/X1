<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use App\Validator\Constraint\UniquePlayerEmail;
use App\Validator\Constraint\UniquePlayerName;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Player extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[NotNull]
    #[NotBlank]
    #[UniquePlayerName]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[NotNull]
    #[NotBlank]
    #[Email]
    #[UniquePlayerEmail]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[PositiveOrZero]
    #[ORM\Column(nullable: true)]
    private ?int $chips = null;

    #[ORM\Column(nullable: true)]
    private ?int $gameId = null;

    #[ORM\OneToOne(targetEntity: Game::class)]
    #[ORM\JoinColumn(name: "game_id", nullable: true, referencedColumnName: "id")]
    private ?Game $game = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getChips(): ?int
    {
        return $this->chips;
    }

    public function setChips(?int $chips): self
    {
        $this->chips = $chips;

        return $this;
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
        $this->master = $game;

        return $this;
    }
}
