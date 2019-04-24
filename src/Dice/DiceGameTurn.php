<?php

namespace Chsv\Dice;

/**
 * Bla bla dice class
 */
class DiceGameTurn extends DiceGame
{
    /**
     * EGENSKAPER
     */

    // Last points
    // Total points in turn
    protected $currentPlayer;
    protected $totalScore;
    protected $lastHand;

    /**
     * Constructor
     *
     * @param
     */
    public function __construct($player)
    {
        $totalScore = 0;
        $this->currentPlayer = $player;
    }

    public function newTry()
    {

    }

    /**
     * Collect turn Points
     *
     * @param int  $player current player
     * @return void
     */
    public function collectTurnPoints()
    {

    }


}
