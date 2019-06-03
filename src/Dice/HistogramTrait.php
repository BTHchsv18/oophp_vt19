<?php

namespace Chsv\Dice;

/**
 * A trait implementing HistogramInterface.
 */
trait HistogramTrait
{
    /**
     * @var array $histogramStats
     */
    private $histogramStats = [];


    /**
     * update the serie.
     *
     * @return null
     */
    public function updateHistogramSerie($diceHandResult)
    {
        for ($i=0; $i<count($diceHandResult); $i++) {
            $this->histogramStats[$diceHandResult[$i]-1]++;
        }
    }


    /**
     * Get the histogramStats.
     *
     * @return array with the histogramStats.
     */
    public function getHistogramSerie()
    {
        return $this->histogramStats;
    }
}
