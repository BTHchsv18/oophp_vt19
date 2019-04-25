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
    public function __construct(int $noofdice = 3)
    {
        $this->dices  = [];
        $this->values = [];

        for ($i = 0; $i < $noofdice; $i++) {
            $this->dices[$i]  = new Dice();
            $this->values[$i] = rand(1, $this->dices[$i]->getNoOfSides());
        }

        $_SESSION['testvariable-2'] = $noofdice;
    }

    /**
     * Get graphic values of last hand
     *
     * @return array of graphical representation of last rolled dice.
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
     * @return bool with values of the last roll.
     */
    public function checkFail()
    {
        $check = false;
        for ($i=0; $i<count($this->values); $i++) {
            if ($this->values[$i] === 1) {
                $check = true;
            }
        }
        return $check;
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


}
