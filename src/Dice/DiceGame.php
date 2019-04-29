<?php

namespace Chsv\Dice;

/**
 * Bla bla dice class
 */
class DiceGame
{
    /**
     * Object properties
     */
    protected $noOfDice;
    protected $players = [];
    protected $standings = [];
    protected $currentPlayer;
    protected $lastHand;

    /**
    * Constructor
    *
    * @param string $playername
    * @param int $noOfDice
    * @param int $opponents
    *
    */
    public function __construct(string $playerName = 'player', int $diceCount = 5, int $opponents = 1)
    {
        $this->players[0] = $playerName;

        for ($i=1; $i<=$opponents; $i++) {
            $this->players[$i] = 'Computer '. $i;
        }

        $this->noOfDice = $diceCount;

        for ($i=0; $i<sizeof($this->players); $i++) {
            $this->standings[$i] = 0;
        }

        $this->currentPlayer = rand(0, count($this->players)-1);
    }


    /**
    * New game turn. Called each time it's a new playerrs turn
    *
    * @return void
    */
    public function nextPlayer()
    {
        $this->currentPlayer++;

        if ($this->currentPlayer >= sizeof($this->players)) {
            $this->currentPlayer = 0;
        }
        $this->currentTurn = new DiceGameTurn();
    }


     /**
      * Get current players index number
      *
      * @return int
      */
    public function getCurrentPlayerNo()
    {
        return $this->currentPlayer;
    }



    /**
    * Computer plays
    *
    * @return boolean
    */
    public function computerPlays()
    {
        $rollOne = false;
        $noOfThrows = 0;
        $won = false;

        do {
            $hand = new DiceHand($this->noOfDice);
            $this->currentTurn->addHand($hand->graphic());
            $rollOne = $hand->handContainsOne();
            $noOfThrows++;
            $this->currentTurn->addScore($hand->sum());
        } while ($noOfThrows < 3 && $rollOne === false);

        if ($rollOne === true) {
            $this->currentTurn->zeroScore();
        }

        $won = $this->updateStandings();

        return $won;
    }



    /**
    * Player plays
    *
    * @return boolean
    */
    public function playerPlays()
    {
        $hand = new DiceHand($this->noOfDice);
        $this->currentTurn->addHand($hand->graphic());
        $rollOne = $hand->handContainsOne();

        if ($rollOne === true) {
            $this->currentTurn->zeroScore();
        } else {
            $this->currentTurn->addScore($hand->sum());
        }

        return $rollOne;
    }



    /**
    * Get acumulated score from last turn
    *
    * @return int score
    */
    public function updateStandings()
    {
        $won = false;
        $this->standings[$this->currentPlayer] += $this->currentTurn->getTurnScore();
        if ($this->standings[$this->currentPlayer] > 99) {
            $won = true;
        }

        return $won;
    }


    /**
    * Get currents standings
    *
    * @return array
    */
    public function getCurrentStandings()
    {
        $scores = [];
        for ($i = 0; $i < sizeof($this->players); $i++) {
            $scores[$i] = $this->players[$i] . ": " . $this->standings[$i];
        }
        return $scores;
    }


    /**
    * Get current Game data for showing in view
    *
    * @return array
    */
    public function gameData()
    {
        $turn = $this->currentPlayer;
        if ($turn === 0) {
            $currentPlayerName = "du";
        } else {
            $currentPlayerName = $this->players[$turn];
        }
            $resultsFromLastTurn = $this->currentTurn->getHandHistory() ?? [''];
            $scoreFromLastTurn = $this->currentTurn->getTurnScore();
            $standings = $this->getCurrentStandings();

        $data = [
            'title' => "100 Dice",
            'turn' => $turn,
            'lastPlayer' => $currentPlayerName,
            'lastTurnResults' => $resultsFromLastTurn,
            'lastTurnScore' => $scoreFromLastTurn,
            'standings' => $standings
        ];

        return $data;
    }
}
