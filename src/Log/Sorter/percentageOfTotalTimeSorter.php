<?php

namespace Log\Sorter;

class percentageOfTotalTimeSorter implements sorterInterface
{
    /**
     * @inheritdoc
     */
    public function sortSummary($summary)
    {
        uasort($summary['Calls'], function ($a, $b) {
            return ($a['PercentageOfTotalTime'] > $b['PercentageOfTotalTime']) ? -1 : 1;
        });

        return $summary;
    }
}