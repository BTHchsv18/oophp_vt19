<?php

namespace Chsv\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceTest extends TestCase
{
    /**
     * is instance of dice
     */
    public function testCreateDiceObject()
    {
        $test = new Dice();
        $this->assertInstanceOf("\Chsv\Dice\Dice", $test);
    }

    /**
     *
     */
    public function testCreateDiceObjectPositiveSides()
    {
        $test = new Dice();
        $res = $test->getNoOfSides();
        $this->assertGreaterThan(0, $res);
    }

    /**
    * Should return int
    */
    public function testgetNoOfSides()
    {
        $test = new Dice();
        $res = $test->getNoOfSides();
        $this->assertInternalType("int", $res);
    }
}
