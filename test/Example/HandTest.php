<?php

namespace Chsv\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class HandTest extends TestCase
{
    /**
     * is instance of hand
     */
    public function testCreatehandObject()
    {
        $test = new DiceHand();
        $this->assertInstanceOf("\Chsv\Dice\DiceHand", $test);
    }


    /**
     *
     *
     */
    public function testHandContainsOne()
    {
        // Expect boolean
        $test = new DiceHand();
        $res = $test->handContainsOne();
        $this->assertInternalType("boolean", $res);
    }

    /**
     *
     */
    public function testValues()
    {
        // Expekt array of int
        $test = new DiceHand();
        $res = $test->values();
        $this->assertInternalType("array", $res);
    }


    /**
     *
     */
    public function testGraphic()
    {
        // Expekt array of int
        $test = new DiceHand();
        $res = $test->graphic();
        $this->assertInternalType("array", $res);
    }

    /**
     *
     */
    public function testSum()
    {
        // Expekt array of int
        $test = new DiceHand();
        $res = $test->sum();
        $this->assertInternalType("int", $res);
    }
}
