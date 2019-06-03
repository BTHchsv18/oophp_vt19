<?php

namespace Chsv\Dice;

/**
 * Bla bla dice class
 */
class DiceGame implements DiceHistogramInterface
{
    use HistogramTrait;

    /**
     * Object properties
     */
    protected $noOfDice;
    protected $players = [];
    protected $standings = [];
    protected $currentPlayer;
    protected $lastHand;

    /**
    * ConstructorStandings
    *
    * @param string $playername
    * @param int $noOfDice
    * @param int $opponents
    *
    */
    public function __construct(string $playerName = 'player', int $diceCount = 5, int $diceSides = 6, int $opponents = 1)
    {
        $this->players[0] = $playerName;

        for ($i=1; $i<=$opponents; $i++) {
            $this->players[$i] = 'Computer '. $i;
        }

        $this->noOfDice = $diceCount;

        for ($i=0; $i<$diceSides; $i++) {
            $this->histogramStats[$i] = 0;
        }

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
        $rollAgain = true;
        $won = false;
        $res;

        do {
            $hand = new DiceHand($this->noOfDice);
            $res = $hand->values();
            $this->updateHistogramSerie($res);
            $this->currentTurn->addHand($hand->graphic());
            $rollOne = $hand->handContainsOne();
            $this->currentTurn->addScore($hand->sum());
            $turnScore = $hand->sum();
            $rollAgain = $this->intelligentPlay($noOfThrows, $turnScore);
            $noOfThrows++;
        } while ($rollAgain === true && $rollOne === false);

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
        $res = $hand->values();
        $this->updateHistogramSerie($res);
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
    public function intelligentPlay($noOfThrows, $turnScore)
    {
        $oppScore = 0;
        $topScore = 0;
        $currPlayerScore = $this->standings[$this->currentPlayer] + $turnScore;

        for ($i=0; $i<count($this->standings); $i++) {
            if ($topScore < $this->standings[$i]) {
                $topScore = $this->standings[$i];
            }
        }

        if ($topScore < $currPlayerScore) {
            $topScore = $currPlayerScore;
        }

        $winProximity = 100 - $topScore;
        $currDiff = $topScore - $currPlayerScore;

        if ($winProximity < 10) {
            $rollAgain = true;
        } elseif ($currDiff > 10 && $noOfThrows < 4) {
            $rollAgain = true;
        } else {
            $rollAgain = false;
        }

        return $rollAgain;
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
            $currentPlayerName = "Du";
        } else {
            $currentPlayerName = $this->players[$turn];
        }
        $resultsFromLastTurn = $this->currentTurn->getHandHistory() ?? [''];
        $scoreFromLastTurn = $this->currentTurn->getTurnScore();
        $standings = $this->getCurrentStandings();
        $hist = $this->histogramStats;

        $data = [
            'title' => "100 Dice",
            'turn' => $turn,
            'lastPlayer' => $currentPlayerName,
            'lastTurnResults' => $resultsFromLastTurn,
            'lastTurnScore' => $scoreFromLastTurn,
            'standings' => $standings,
            'histoGramStats' => $hist,
        ];

        return $data;
    }
}
