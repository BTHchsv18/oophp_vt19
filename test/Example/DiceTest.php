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
        $this->assertInstanceOf("\Chsv18\Dice\Dice", $test);
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
