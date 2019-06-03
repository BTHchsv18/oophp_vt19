<?php

namespace Chsv\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class GameTest extends TestCase
{
    public function testCreateTurnObject()
    {
        $test = new DiceGame();
        $this->assertInstanceOf("\Chsv\Dice\DiceGame", $test);
    }


    public function testnextPlayer()
    {
        $test = new DiceGame();
        $res = $test->nextPlayer();
        $this->assertNull($res);
    }



    public function testgetCurrentPlayerNo()
    {
        $test = new DiceGame();
        $res = $test->getCurrentPlayerNo();
        $this->assertInternalType("int", $res);
    }


    public function testcomputerPlays()
    {
        $test = new DiceGame();
        $test->nextPlayer();
        $res = $test->computerPlays();
        $this->assertInternalType("boolean", $res);
    }


    public function testplayerPlays()
    {
        $test = new DiceGame();
        $test->nextPlayer();
        $res = $test->playerPlays();
        $this->assertInternalType("boolean", $res);
    }



    public function testupdateStandings()
    {
        $test = new DiceGame();
        $test->nextPlayer();
        $res = $test->updateStandings();
        $this->assertInternalType("boolean", $res);
    }



    public function testgetCurrentStandings()
    {
        $test = new DiceGame();
        $test->nextPlayer();
        $res = $test->getCurrentStandings();
        $this->assertInternalType("array", $res);
    }


    public function testgameData()
    {
        $test = new DiceGame();
        $test->nextPlayer();
        $res = $test->gameData();
        $this->assertInternalType("array", $res);
    }
}
