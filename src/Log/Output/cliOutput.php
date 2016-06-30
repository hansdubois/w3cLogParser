<?php
namespace Log\Output;

class cliOutput
{
    const mask = "| %-20.20s | %-15.15s | %-15.15s | %-22.22s | %-15.15s | %-22.22s |\n";

    public function printOutput($summary)
    {
        $this->printHeader();
        $this->printEntries($summary);
        $this->printFooter();
    }

    private function printHeader()
    {

        printf("%s\n",
            "--------------------------------------------------------------------------------------------------------------------------------");
        printf(self::mask, 'Call', '% Of total calls.', '% Of total time.', 'Total time taken (ms)', 'Total calls',
            'Average Time (ms)');
        printf("%s\n",
            "--------------------------------------------------------------------------------------------------------------------------------");
    }

    private function printEntries($summary)
    {
        foreach ($summary['Calls'] as $section => $call) {
            printf(self::mask, $section, number_format($call['PercentageOfTotalCalls'], 2),
                number_format($call['PercentageOfTotalTime'], 2), $call['duration']['total'],
                $call['callCount']['total'], $call['Averages']['TimeTaken']['Total']);
        }
    }

    private function printFooter()
    {
        printf("%s\n",
            "--------------------------------------------------------------------------------------------------------------------------------");

    }
}