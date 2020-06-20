<?php

namespace App;

use App\Helpers\CliHelper;
use App\Helpers\Referee;
use App\Model\Dealer;
use App\Model\Deck;
use App\Model\Player;

class GameRunner
{
    /**
     * @var string
     */
    public $playerName = 'Player';
    /**
     * @var integer
     */
    public $delay;
    /**
     * @var Deck
     */
    private $deck;
    /**
     * @var Player
     */
    private $player;
    /**
     * @var Dealer
     */
    private $dealer;
    /**
     * @var Referee
     */
    private $referee;

    public function __construct($playerName, $delay)
    {
        if (!empty($playerName)) {
            $this->playerName = $playerName;
        }
        $this->delay = $delay;
        $this->deck = new Deck();

        $this->player = new Player($this->playerName, $this->deck);
        $this->player->getHand()->startHand($this->deck);
        $this->dealer = new Dealer('Dealer', $this->deck);
        $this->dealer->hit();

        $this->referee = new Referee($this->player, $this->dealer);
    }

    public function startGame(): void
    {
        CliHelper::startCountdown($this->delay);

        $winner = $this->gameLoop();

        echo "------------------------" . PHP_EOL;

        if (null === $winner) {
            echo "Its Draw" . PHP_EOL;
            return;
        }

        echo "Winner is: " . (string)$winner . PHP_EOL;
    }

    /**
     * null means its a draw otherwise returns the winner
     *
     * @param bool $isStay
     * @return Player|null
     */
    private function gameLoop(bool $isStay = false): ?Player
    {
        $player = $this->player;
        $dealer = $this->dealer;

        echo "----------------------------" . PHP_EOL;

        $dealer->showCards();
        $player->showAllCards();

        // check for someone is finished
        $isSomeoneFinished = $this->referee->checkForFinished();
        if (false !== $isSomeoneFinished) {
            return $isSomeoneFinished;
        }

        // check for busted
        $isSomeoneBusted = $this->referee->checkForBusted();
        if (false !== $isSomeoneBusted) {
            return $isSomeoneBusted;
        }

        // check for point
        if ($isStay) {
            return $this->referee->checkForWinner();
        }

        if ($player->getHand()->getTotal() < 21) {
            $isHit = (strtoupper(CliHelper::readLine('Hit(h) or Stay(s)')) == 'H');

            if ($isHit) {
                $player->hit();
            }

            return $this->gameLoop(!$isHit);
        }

        return $this->gameLoop(true);
    }
}