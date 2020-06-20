<?php

namespace App\Model;

class Player
{
    protected $name;
    private $deck;
    private $hand;
    private $isBusted = false;
    /**
     * Player constructor.
     * @param $name
     * @param $deck
     */
    public function __construct(string $name, Deck $deck)
    {
        $this->setName($name);
        $this->setDeck($deck);
        $this->setHand(new Hand());
    }

    public function hit()
    {
        $this->getHand()->addCard($this->deck->pickCard());
        if ($this->hand->getTotal() > 21) {
            $this->isBusted = true;
        }
    }

    public function showAllCards()
    {
        echo sprintf("%s's hand%s", $this->getName(), PHP_EOL);
        foreach ($this->hand->getAllCards() as $card) {
            echo (string)$card . PHP_EOL;
        }

        echo sprintf("total %s%s", $this->hand->getTotal(), PHP_EOL);
    }

    /**
     * @return bool
     */
    public function isBusted(): bool
    {
        return $this->isBusted;
    }

    /**
     * @return Hand
     */
    public function getHand(): Hand
    {
        return $this->hand;
    }

    /**
     * @param Hand $hand
     */
    public function setHand(Hand $hand): void
    {
        $this->hand = $hand;
    }

    /**
     * @param Deck $deck
     */
    public function setDeck(Deck $deck): void
    {
        $this->deck = $deck;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->getName();
    }
}