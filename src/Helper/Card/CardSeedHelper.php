<?php

namespace App\Helper\Card;

use App\Constant\CardConstant;
use App\Entity\Card;
use App\Repository\CardRepository;
use DateTimeImmutable;
use DateTimeZone;

class CardSeedHelper
{
    private const CARDS_JSON = __DIR__."/cards/cards.json";

    public function __construct(
        private readonly CardRepository $cardRepository
    ) {}

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
        $names = "spades ace,spades 2,spades 3,spades 4,spades 5,spades 6,spades 7,spades 8,spades 9,spades 10,spades jack,spades queen,spades king,hearts ace,hearts 2,hearts 3,hearts 4,hearts 5,hearts 6,hearts 7,hearts 8,hearts 9,hearts 10,hearts jack,hearts queen,hearts king,clubs ace,clubs 2,clubs 3,clubs 4,clubs 5,clubs 6,clubs 7,clubs 8,clubs 9,clubs 10,clubs jack,clubs queen,clubs king,diamonds ace,diamonds 2,diamonds 3,diamonds 4,diamonds 5,diamonds 6,diamonds 7,diamonds 8,diamonds 9,diamonds 10,diamonds jack,diamonds queen,diamonds king";
        $symbols = "1♠,2♠,3♠,4♠,5♠,6♠,7♠,8♠,9♠,10♠,J♠,Q♠,K♠,1♥,2♥,3♥,4♥,5♥,6♥,7♥,8♥,9♥,10♥,J♥,Q♥,K♥,1♣,2♣,3♣,4♣,5♣,6♣,7♣,8♣,9♣,10♣,J♣,Q♣,K♣,1♦,2♦,3♦,4♦,5♦,6♦,7♦,8♦,9♦,10♦,J♦,Q♦,K♦";
        $result = [];
        $namesArr = explode(",", $names);
        $symbolsArr = explode(",", $symbols);
        foreach ($namesArr as $i => $name)
        {
            $image = __DIR__."/cards/".explode(" ", $name)[0]."_".explode(" ", $name)[1].".png";
            $base64 = "data:image/png;base64,".base64_encode(file_get_contents($image));
            $result[explode(" ", $name)[0]][] = [
                "name" => $name,
                "symbol" => $symbolsArr[$i],
                "card" => $base64
            ];
        }

        file_put_contents(__DIR__."/cards/cards.json", json_encode($result));
    }
}
