<?php
/**
 * Created by PhpStorm.
 * User: anthony.kem
 * Date: 15/02/2016
 * Time: 13:43
 */

namespace tests\AppBundle\Kata;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Kata\Bowling;

// Test Kata Bowling
class BowlingTest extends WebTestCase
{
    private $bowling;

    protected function setUp()
    {
        $this->bowling = new Bowling();
    }

    /**
     *  0 pin in each roll
     */
    public function testBowlingAllZeros()
    {
        $this->bowling->rollMany(20, 0);
        $this->assertEquals(0, $this->bowling->getScore());
    }

    /**
     *  1 pin in each roll
     */
    public function testBowlingAllOnes()
    {
        $this->bowling->rollMany(20, 1);
        $this->assertEquals(20, $this->bowling->getScore());
    }

    /**
     *  1 spare, then 3 pin in the following roll, then 0
     */
    public function testBowlingOneSpare()
    {
        $this->rollSpare();
        $this->bowling->roll(3);
        $this->bowling->rollMany(17, 0);

        $this->assertEquals(16, $this->bowling->getScore());
    }

    /**
     *  One strike, 3 pins, 4 pins, then 0
     */
    public function testBowlingOneStrike()
    {
        $this->rollStrike();
        $this->bowling->roll(3);
        $this->bowling->roll(4);
        $this->bowling->rollMany(16, 0);

        $this->assertEquals(24, $this->bowling->getScore());
    }

    /**
     * All strikes
     */
    public function testBowlingPerfectGame()
    {
        $this->bowling->rollMany(12, 10);

        $this->assertEquals(300, $this->bowling->getScore());
    }

    private function rollSpare()
    {
        $this->bowling->roll(4);
        $this->bowling->roll(6);
    }

    private function rollStrike()
    {
        $this->bowling->roll(10);
    }
}
