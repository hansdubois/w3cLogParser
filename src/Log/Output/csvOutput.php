<?php
namespace Log\Output;

class csvOutput
{
    private function parseHeader()
    {
        echo "Call, % Of total calls., % Of total time., Total time taken (ms), Total calls, Average Time (ms) \n";
    }

    private function parseSummary($summary)
    {
        foreach ($summary['Calls'] as $section => $call) {
            echo $section . "," . number_format($call['PercentageOfTotalCalls'],
                    2) . "," . number_format($call['PercentageOfTotalTime'], 2) .
                "," . $call['duration']['total'] . "," . $call['callCount']['total'] . "," . $call['Averages']['TimeTaken']['Total'] . "\n";
        }
    }

    public function printOutput($summary)
    {
        $this->parseHeader();
        $this->parseSummary($summary);
    }
}