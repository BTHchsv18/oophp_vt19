<?php

namespace Chsv\Dice;

/**
 * Bla bla dice class
 */
class DiceGame
{
    /**
     * EGENSKAPER
     */
     protected $players;
     protected $noofdice;
     protected $playerTurn;
     protected $standings;


     /**
      * Constructor
      *
      * @param
      */
     public function __construct(array $players, int $noofdice = 6)
     {
         $this->players = $players;
         $this->noofdice = $noofdice;

         $this->playerTurn = rand(0, count($this->players)-1);

         $this->standings[0] = $this->standings[1] = 0;
     }

     /**
      * Get player turnss
      *
      * @return string
      */
     public function getPlayerTurn()
     {
         return $this->players[$this->playerTurn];
     }

     /**
      * Get currents standings
      *
      * @return int no of sides
      */
     public function getCurrentStandings()
     {
        for ($i = 0; $i < count($this->standings); $i++) {
            $standings[$i] = $this->players[$i] . ": " . $this->standings [$i];
        }
        return $standings;
     }



}
