<?php

namespace Chsv\Dice;

/**
 * Bla bla dice class
 */
class Dice extends DiceHand
{
    /**
     * @var integer $sides  Number of sides
     */
    private $sides;
    private $lastRoll;

    /**
     * Constructor to create a Dice
     *
     * @param null|int    $sides  Number of sides. Default: 6
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    /**
     * Destroy instance
     */
    public function __destruct()
    {
    }

    /**
     * Get the number of sides in current dice
     *
     * @return int no of sides
     */
    public function getNoOfSides()
    {
        return $this->sides;
    }

}
