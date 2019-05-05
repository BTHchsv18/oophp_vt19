<?php

namespace Chsv\Dice;

/**
 * Bla bla dice class
 */
class DiceGameTurn
{
    /**
     * EGENSKAPER
     */

    protected $turnHistory;
    protected $turnScore;

    /**
     * Constructor
     *
     * @param
     */
    public function __construct()
    {
        $this->turnScore = 0;
        $this->turnHistory=  [];
    }


    /**
     * Adds played hand to turn history
     *
     * @return void
     */
    public function addHand($lastHand)
    {
        if (isset($lastHand) && $lastHand != null) {
            $this->turnHistory[] = $lastHand;
        } else {
            throw new DiceException("ot valid");
        }
    }


    /**
     * Adds score to accumulated turn score
     *
     * @return void
     */
    public function zeroScore()
    {
        $this->turnScore = 0;
    }


    /**
     * Adds score to accumulated turn score
     *
     * @return void
     */
    public function addScore($handScore)
    {
        if (isset($handScore) && $handScore != null) {
            $this->turnScore += $handScore;
        } else {
            throw new DiceException("ot valid");
        }
    }


    /**
     * get hands played in turn
     *
     * @return array
     */
    public function getHandHistory()
    {
        return $this->turnHistory;
    }


    /**
     * gets total score acumulated in turn
     *
     * @return int
     */
    public function getTurnScore()
    {
        return $this->turnScore;
    }
}
