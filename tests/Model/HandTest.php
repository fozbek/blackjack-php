<?php

namespace Model;

use App\Model\Card;
use App\Model\Deck;
use App\Model\Hand;
use App\Model\Player;
use PHPUnit\Framework\TestCase;

class HandTest extends TestCase
{
    public function testAddCard()
    {
        $card = new Card('Clubs', 'Jack', 10);
        $hand = new Hand();
        $hand->addCard($card);

        $this->assertEquals($hand->getTotal(), 10);
    }

    public function testGetTotal()
    {
        $hand = new Hand();
        $this->assertEquals($hand->getTotal(), 0);

        $card = new Card('Hearts', '2', 2);
        $hand->addCard($card);
        $this->assertEquals($hand->getTotal(), 2);

        $card = new Card('Hearts', '6', 6);
        $hand->addCard($card);
        $this->assertEquals($hand->getTotal(), 8);
    }

    public function testStartHand()
    {
        $deck = new Deck();
        $player = new Player('Player', $deck);
        $player->getHand()->startHand($deck);

        $this->assertNotEquals($player->getHand()->getTotal(), 0);

        $this->assertCount(2, $player->getHand()->getAllCards());
    }
}
