<?php
/**
 * Created by PhpStorm.
 * User: anthony.kem
 * Date: 15/02/2016
 * Time: 13:43
 */

namespace AppBundle\Kata;


class Bowling
{
    private $rolls;
    private $currentRoll;

    public function __construct()
    {
        $this->rolls = array();
        $this->currentRoll = 0;
    }

    public function roll($pins)
    {
        $this->rolls[$this->currentRoll] = $pins;
        $this->currentRoll++;
    }

    public function rollMany($rolls, $pins)
    {
        for ($roll = 0; $roll < $rolls; $roll++) {
            $this->rolls[$this->currentRoll] = $pins;
            $this->currentRoll++;
        }
    }

    public function getScore()
    {
        $score = 0;
        $rollIndex = 0;
        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->isStrike($rollIndex)) {
                $score += 10 + $this->getStrikeBonus($rollIndex);
                $rollIndex += 1;
            } else if ($this->isSpare($rollIndex)) {
                $score += 10 + $this->getSpareBonus($rollIndex);
                $rollIndex += 2;
            } else {
                $score += $this->rolls[$rollIndex] + $this->rolls[$rollIndex + 1];
                $rollIndex += 2;
            }
        }

        return $score;
    }

    private function isSpare($rollIndex)
    {
        if ($this->rolls[$rollIndex] + $this->rolls[$rollIndex + 1] === 10) {
            return true;
        } else {
            return false;
        }
    }

    private function isStrike($rollIndex)
    {
        if ($this->rolls[$rollIndex] === 10) {
            return true;
        } else {
            return false;
        }
    }

    private function getSpareBonus($rollIndex)
    {
        return  $this->rolls[$rollIndex + 2];
    }
    
    private function getStrikeBonus($rollIndex)
    {
        return $this->rolls[$rollIndex + 1] + $this->rolls[$rollIndex + 2];
    }
}