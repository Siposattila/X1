<?php

namespace App\Helper\Card;

use App\Constant\CardConstant;
use App\Entity\Card;
use App\Repository\CardRepository;
use DateTimeImmutable;
use DateTimeZone;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CardSeedHelper
{
    // TODO: Might be better to not use Process! Instead use this class to make the cards.json. :)
    private const CARDS_JSON = __DIR__."/cards/cards.json";

    public function __construct(
        private readonly CardRepository $cardRepository
    ){}

    public function seed(): void
    {
        if (count($this->cardRepository->findAll()) != CardConstant::CARD_PACK_SIZE) {
            if (!file_exists(self::CARDS_JSON)) {
                $this->runGeneration();
            }
    
            $cardPack = json_decode(file_get_contents(self::CARDS_JSON), true);
            foreach ($cardPack as $colour => $cards) {
                foreach ($cards as $card) {
                    $newCard = new Card();
                    $newCard->setName($card["name"]);
                    $newCard->setColour(CardConstant::getColourByName($colour));
                    $newCard->setSymbol($card["symbol"]);
                    $newCard->setCard($card["card"]);
                    $newCard->setCreatedAt(new DateTimeImmutable("now", new DateTimeZone("Europe/Budapest")));
                    $newCard->setUpdatedAt(new DateTimeImmutable("now", new DateTimeZone("Europe/Budapest")));
                    $this->cardRepository->save($newCard, true);
                }
            }
        }
    }

    private function runGeneration(): void
    {
        $process = new Process(["php", __DIR__."/cards/make.php"]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}
