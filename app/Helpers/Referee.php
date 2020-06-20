<?php

namespace App\Helpers;

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
        if ($this->player->getHand()->getTotal() == 21) {
            if ($this->dealer->getHand()->getTotal() == 21) {
                return null;
            } else {
                return $this->player;
            }
        }

        return false;
    }

    /**
     * Checks for is someone busted
     * @return bool|null|Player
     */
    public function checkForBusted()
    {
        if ($this->player->isBusted()) {
            $this->player->showAllCards();
            if ($this->dealer->isBusted()) {
                return null;
            } else {
                return $this->dealer;
            }
        }

        return false;
    }

    public function checkForWinner()
    {
        if ($this->dealer->getHand()->getTotal() == $this->player->getHand()->getTotal()) {
            return null;
        }

        return ($this->dealer->getHand()->getTotal() > $this->player->getHand()->getTotal())
            ? $this->dealer : $this->player;
    }
}