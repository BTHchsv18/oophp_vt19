<?php

namespace Chsv\Dice;

/**
 * Bla bla dice class
 */
class DicePlayer
{
    /**
     * @var integer $sides  Number of sides
     */
    protected $name;
    protected $handHistory;

    /**
     * Constructor to create a Dice
     *
     * @param string $name
     */
    public function __construct(string $playername = 'player')
    {
        $this->name = $name;
    }

    /**
     * Destroy instance
     */
    public function __destruct()
    {
    }
}
