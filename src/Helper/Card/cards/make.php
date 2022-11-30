<?php

$cards = "spades ace,spades 2,spades 3,spades 4,spades 5,spades 6,spades 7,spades 8,spades 9,spades 10,spades jack,spades queen,spades king,hearts ace,hearts 2,hearts 3,hearts 4,hearts 5,hearts 6,hearts 7,hearts 8,hearts 9,hearts 10,hearts jack,hearts queen,hearts king,clubs ace,clubs 2,clubs 3,clubs 4,clubs 5,clubs 6,clubs 7,clubs 8,clubs 9,clubs 10,clubs jack,clubs queen,clubs king,diamonds ace,diamonds 2,diamonds 3,diamonds 4,diamonds 5,diamonds 6,diamonds 7,diamonds 8,diamonds 9,diamonds 10,diamonds jack,diamonds queen,diamonds king";
$syms = "1♠,2♠,3♠,4♠,5♠,6♠,7♠,8♠,9♠,10♠,J♠,Q♠,K♠,1♥,2♥,3♥,4♥,5♥,6♥,7♥,8♥,9♥,10♥,J♥,Q♥,K♥,1♣,2♣,3♣,4♣,5♣,6♣,7♣,8♣,9♣,10♣,J♣,Q♣,K♣,1♦,2♦,3♦,4♦,5♦,6♦,7♦,8♦,9♦,10♦,J♦,Q♦,K♦";

function MakeCardArray(string $names, string $symbols): array
{
    $result = [];
    $namesArr = explode(",", $names);
    $symbolsArr = explode(",", $symbols);
    foreach ($namesArr as $i => $name)
    {
        $image = __DIR__."/".explode(" ", $name)[0]."_".explode(" ", $name)[1].".png";
        $base64 = "data:image/png;base64,".base64_encode(file_get_contents($image));
        $result[explode(" ", $name)[0]][] = [
            "name" => $name,
            "symbol" => $symbolsArr[$i],
            "card" => $base64
        ];
    }

    return $result;
}

file_put_contents(__DIR__."/cards.json", json_encode(MakeCardArray($cards, $syms)));
