<?php
namespace Log\Sorter;

interface sorterInterface
{
    /**
     * Sort the summary
     * @param $summary
     * @return array the sorted summary
     */
    public function sortSummary($summary);
}