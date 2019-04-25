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
     protected $currentTurn;
     protected $players = [];
     protected $noOfDice;
     protected $standings = [];
     protected $currentPlayer;
     protected $lastHand;
     protected $turnScore = 0; //place in object

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
     public function nextGameTurn()
     {
         $this->currentPlayer++;
         if ($this->currentPlayer >= sizeof($this->players))
         {
             $this->currentPlayer = 0;
         }
         $this->currentTurn = new DiceGameTurn($this->currentPlayer, $this->noOfDice);
     }


     /**
      * Player plays
      *
      * @return string
      */
     public function playerPlays()
     {
         $result = $this->currentTurn->playerHand();
         return $result;
     }


     /**
      * Computer plays
      *
      * @return string
      */
     public function computerPlays()
     {
         $result = $this->currentTurn->simulatedTurn();
         $this->addPlayerScore();
         return $result;
     }


     /**
      * get results from last hand (values)
      *
      * @return string
      */
     public function getLastHand()
     {
         return $this->currentTurn->lastHand;
     }


     /**
      * Get score from last turn
      *
      * @return int score
      */
     public function getLastScore()
     {
        return $this->currentTurn->turnScore;
     }


     /**
      * Add players score
      *
      * @return void
      */
     public function addPlayerScore()
     {
         $this->standings[$this->currentTurn->currentPlayer] += $this->currentTurn->turnScore;
     }


     /**
      * Get no of dice in current game
      *
      * @return int
      */
     public function getNoOfDice()
     {
         return $this->noOfDice;
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
      * Get current players name
      *
      * @return string
      */
     public function getCurrentPlayerName()
     {
         return $this->players[$this->currentPlayer];
     }

     /**
      * Get currents standings
      *
      * @return int no of sides
      */
     public function getCurrentStandings()
     {
        $standings = [];
        for ($i = 0; $i < sizeof($this->players); $i++) {
            $standings[$i] = $this->players[$i] . ": " . $this->standings[$i];
        }
        return $standings;
     }

}
