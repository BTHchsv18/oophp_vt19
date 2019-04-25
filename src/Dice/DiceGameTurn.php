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

    // Total points in turn
    protected $currentPlayer;
    protected $turnScore;
    protected $totalScore;
    protected $noOfDice;
    protected $lastHand;

    /**
     * Constructor
     *
     * @param
     */
    public function __construct(int $player = 0, int $noOfDice = 3)
    {
        $this->turnScore = 0;
        $this->totalScore = 0;
        $this->currentPlayer = $player;
        $this->noOfDice = $noOfDice;
    }


    /**
     * Player plays
     *
     * @return string
     */
    public function playerHand()
    {
        $resultsGraphic = [];
        $rollOne = false;
        $throws = 0;

        $hand = new DiceHand($this->noOfDice);
        $roll = $hand->values();
        $this->lastHand = $hand->graphic();

        for ($i = 0; $i < sizeof($roll); $i++) {
            if ($roll[$i] === 1) {
                $rollOne = true;
            }
        }

       if ($rollOne === false) {
           $this->turnScore += $hand->sum();
       } else {
           $this->turnScore = 0;
       }

        return $rollOne;

    }


    /**
     * Computer plays
     *
     * @return string
     */
    public function simulatedTurn()
    {
        $resultsGraphic = [];
        $rollOne = false;
        $noOfThrows = 0;
        $this->turnScore = 0;

        do {
            $hand = new DiceHand($this->noOfDice);
            $roll = $hand->values();

            for ($i = 0; $i < sizeof($roll); $i++) {
                if ($roll[$i] === 1) {
                    $rollOne = true;
                }
            }

            if ($rollOne === false) {
                $this->turnScore += $hand->sum();
            }

            $resultsGraphic[] = $hand->graphic();
            $noOfThrows++;
        } while ($noOfThrows < 3 && $rollOne === false);

        if ($rollOne === true) {
            $this->turnScore = 0;
        }
        return $resultsGraphic;
    }

}
