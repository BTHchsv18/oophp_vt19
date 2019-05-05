<?php

namespace Chsv\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class TurnTest extends TestCase
{
    /**
     *
     */
    public function testCreateTurnObject()
    {
        $test = new DiceGameTurn();
        $this->assertInstanceOf("\Chsv\Dice\DiceGameTurn", $test);
    }

    /**
     *
     */
    public function testaddHand()
    {
        $test = new DiceGameTurn();
        $res = $test->addHand(['a', 'b'. 'c']);
        $this->assertNull($res);
    }


    /**
     *
     */
    public function testaddHandExceptipon()
    {
        $test = new DiceGameTurn();
        $this->expectException(DiceException::class);
        $res = $test->addHand("");
    }



    /**
     *
     */
    public function testaddscore()
    {
        $test = new DiceGameTurn();
        $this->expectException(DiceException::class);
        $res = $test->addScore("");
    }


    /**
     *
     */
    public function testzeroScore()
    {
        $test = new DiceGameTurn();
        $res = $test->zeroScore();
        $this->assertNull($res);
    }


    /**
     *
     */
    public function testgetHandHistory()
    {
        // Expected array
        $test = new DiceGameTurn();
        $res = $test->getHandHistory();
        $this->assertInternalType("array", $res);
    }


    /**
     *
     */
    public function testgetTurnScore()
    {
        // Expected int
        $test = new DiceGameTurn();
        $res = $test->getTurnScore();
        $this->assertInternalType("int", $res);
    }
}
