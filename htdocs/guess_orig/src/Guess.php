<?php

/**
 * Class that handles guesses in game guess my number
 */
class Guess
{
    /**
     * @var integer $number    Number to guess in current game
     * @var integer $tries      Number of tries
     */
    private $number;
    private $tries;

    /**
     * Constructor to create instance
     *
     * @param int    $userguess  Current guess
     */
    public function __construct()
    {
        $this->number = rand(1, 100);
        $this->tries = 5;
    }

    /**
     * Destroy
     */
    public function __destruct()
    {
    }


    /**
     * Print out details of guess
     * @param int $userguess    The number user guessed
     * @return string with details of comparison
     */
    public function getnumber()
    {
        return $this->number;
    }


    /**
     * Print out details of guess
     * @param int $userguess    The number user guessed
     * @return string with details of comparison
     */
    public function gettriesleft()
    {
        return $this->tries;
    }

    /**
     * Print out details of guess
     * @param int $userguess    The number user guessed
     * @return string with details of comparison
     */
    public function checkguess(int $guess = null)
    {
        if ($this->tries > 0) {
            $this->tries = $this->tries - 1;
            if ($guess > 100 || $guess < 1) {
                 throw new GuessException("Out of range");
            } elseif ($guess === $this->number) {
                return "CORRECT";
            } elseif ($guess > $this->number) {
                return "TOO HIGH";
            } else {
                return "TOO LOW";
            }
        }
    }
}
