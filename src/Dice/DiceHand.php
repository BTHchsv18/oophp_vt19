<?php

namespace Chsv\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand extends DiceGame
{
    /**
     * @var Dice $dices   Array consisting of dices.
     * @var int  $values  Array consisting of last roll of the dices.
     */
    protected $dices;
    protected $values;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct()
    {
        $this->dices  = [];
        $this->values = [];

        for ($i = 0; $i < ($this->noofdice); $i++) {
            $this->dices[$i]  = new Dice();
            $this->values[$i] = rand(1, $this->dices[$i]->getNoOfSides());
        }
    }

    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of last rolled dice.
     */
    public function graphic()
    {
        $graphicValues = [];

        for ($i=0; $i<sizeof($this->values); $i++) {
            $graphicValues[$i] = "dice-" . $this->values[$i];
        }

        return $graphicValues;

    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return $this->values;
    }


    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        return array_sum($this->values);
    }


    /**
     * Get the average of all dices.
     *
     * @return float as the average of all dices.
     */
    public function average()
    {
        return array_sum($this->values) / sizeof($this->values);
    }
}
