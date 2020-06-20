<?php

namespace App\Model;

class Dealer extends Player
{
    public function hit()
    {
        while ($this->getHand()->getTotal() < 16) {
            parent::hit();
        }
    }

    public function showCards()
    {
        echo sprintf("%s's hand%s", $this, PHP_EOL);
        echo (string)$this->getHand()->getAllCards()[count($this->getHand()->getAllCards()) - 1] . PHP_EOL;
    }
}