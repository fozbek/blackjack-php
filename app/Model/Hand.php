<?php

namespace App\Model;

class Hand
{
    const MAX_POINT = 21;
    private $cards = [];
    private $hasAce = false;

    public function addCard(Card $card): void
    {
        $this->cards[] = $card;
    }

    public function getTotal(): int
    {
        $handTotal = 0;
        foreach ($this->cards as $card) {
            if ($card->isAce()) {
                $this->hasAce = true;
            }
            $handTotal += $card->getValue();
        }

        if ($this->hasAce && ($handTotal + 10) <= self::MAX_POINT) {
            $handTotal += 10;
        }

        return $handTotal;
    }

    public function startHand(Deck $deck): void
    {
        $this->addCard($deck->pickCard());
        $this->addCard($deck->pickCard());
    }

    public function hasAce(): bool
    {
        return $this->hasAce;
    }

    public function getAllCards(): array
    {
        return $this->cards;
    }
}