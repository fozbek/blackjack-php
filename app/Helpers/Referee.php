<?php

namespace App\Helpers;

use App\Model\Hand;
use App\Model\Player;

class Referee
{
    private $player;
    private $dealer;

    /**
     * Referee constructor.
     * @param $player
     * @param $dealer
     */
    public function __construct($player, $dealer)
    {
        $this->player = $player;
        $this->dealer = $dealer;
    }

    /**
     * Checks for is someone finished
     * @return bool|null|Player
     */
    public function checkForFinished()
    {
        if ($this->player->getHand()->getTotal() == Hand::MAX_POINT
            && $this->dealer->getHand()->getTotal() == Hand::MAX_POINT) {
            return null;
        }

        if ($this->player->getHand()->getTotal() == Hand::MAX_POINT) {
            return $this->player;
        }

        if ($this->dealer->getHand()->getTotal() == Hand::MAX_POINT) {
            return $this->dealer;
        }

        return false;
    }

    /**
     * Checks for is someone busted
     * @return bool|null|Player
     */
    public function checkForBusted()
    {
        if ($this->player->isBusted() && $this->dealer->isBusted()) {
            $this->player->showAllCards();
            return null;
        }

        if ($this->player->isBusted()) {
            $this->player->showAllCards();
            return $this->dealer;
        }

        if ($this->dealer->isBusted()) {
            return $this->player;
        }

        return false;
    }

    public function checkForWinner()
    {
        if ($this->dealer->getHand()->getTotal() == $this->player->getHand()->getTotal()) {
            return null;
        }

        if ($this->dealer->getHand()->getTotal() > $this->player->getHand()->getTotal()) {
            return $this->dealer;
        }

        return $this->player;
    }
}