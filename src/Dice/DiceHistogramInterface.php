<?php

namespace Chsv\Dice;

/**
 * A interface for a classes supporting histogram reports.
 */
interface DiceHistogramInterface
{
    /**
     * Update
     *
     * @return null
     */
    public function updateHistogramSerie($diceHandResult);


    /**
     * Get min value for the histogram.
     *
     * @return int with the min value.
     */
    public function getHistogramSerie();
}
