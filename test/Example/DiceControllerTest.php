<?php

namespace Chsv\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceControllerTest extends TestCase
{
    use AppInjectableTrait;
    /**
     * is instance of dice
     */
    public function testIndex()
    {
        $test = new DiceController();
        $res = $test->indexAction();
        $this->assertInternalType("string", $res);
    }

    // public function testsetupAction()
    // {
    //
    // }
    //
    // public function testinitActionPost()
    // {
    //
    // }
    //
    // public function testhandleturnActionGet()
    // {
    //
    // }
    //
    // public function testcomputersturnActionGet()
    // {
    //
    // }
    //
    // public function testplayersturnActionGet()
    // {
    //
    // }
    //
    // public function testrollActionGet()
    // {
    //
    // }
    //
    //
    // public function teststandActionGet()
    // {
    //
    // }
    //
    //
    // public function debugAction() : string
    // {
    //
    // }
}
