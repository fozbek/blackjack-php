<?php

namespace App\Model;

class Deck
{
    const cardTypes = ["Hearts", "Spades", "Clubs", "Diamonds"];
    const cardValues = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 10, 10, 10];
    const cardNames = ["Ace", 2, 3, 4, 5, 6, 7, 8, 9, 10, "Jack", "Queen", "King"];
    const TOTAL_CARD_COUNT = 312;

    private $cards = [];

    /**
     * Deck constructor.
     */
    public function __construct()
    {
        $this->initCards();
        $this->shuffle();
    }

    private function initCards()
    {
        foreach (self::cardTypes as $type) {
            foreach (self::cardValues as $valueIndex => $cardValue) {
                $card = new Card($type, self::cardNames[$valueIndex], $cardValue);
                $this->addCard($card);
            }
        }

        $tempDeck = $this->cards;
        foreach (range(1, 5) as $th) {
            $this->cards = array_merge($tempDeck, $this->cards);
        }
    }

    private function addCard(Card $card): void
    {
        $this->cards[] = $card;
    }

    public function pickCard(): Card
    {
        return array_splice($this->cards, 0, 1)[0];
    }

    private function shuffle()
    {
        shuffle($this->cards);
    }

    public function getCardCount()
    {
        return count($this->cards);
    }
}