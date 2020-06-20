<?php

namespace Model;

use App\Model\Card;
use App\Model\Deck;
use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase
{

    public function testPickCard()
    {
        $deck = new Deck();
        $initCardCount = $deck->getCardCount();
        $this->assertEquals($initCardCount, Deck::TOTAL_CARD_COUNT);

        $pickedCard = $deck->pickCard();
        $this->assertNotEquals($deck->getCardCount(), $initCardCount);

        $this->assertInstanceOf(Card::class, $pickedCard);
    }
}
