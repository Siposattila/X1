<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

#[ORM\Entity(repositoryClass: CardRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Card extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[NotNull]
    #[NotBlank]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[NotNull]
    #[NotBlank]
    #[ORM\Column(nullable: true)]
    private ?int $colour = null;

    #[NotNull]
    #[NotBlank]
    #[ORM\Column(type: Types::TEXT, nullable: true, options: ["comment" => "Base64 representation of a card."])]
    private ?string $card = null;

    #[ORM\Column(length: 3, nullable: true)]
    private ?string $symbol = null;

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

    public function getColour(): ?int
    {
        return $this->colour;
    }

    public function setColour(?int $colour): self
    {
        $this->colour = $colour;

        return $this;
    }

    public function getCard(): ?string
    {
        return $this->card;
    }

    public function setCard(?string $card): self
    {
        $this->card = $card;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(?string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }
}
