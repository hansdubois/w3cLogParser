# W3C Log parser
A log parser that can be used to parse W3C log messages. Commonly used by IIS services.

The parser groups them by request an gives back:
* Total Calls
* Total Time Taken
* Average Time per Call
* % of total Calls
* % of total Time taken

## Output
Be default there are two outputs available: CSV and a cli output.

## Usage
```
$logs = [
   "logs/u_ex160619.log"
];

$logParser = new \Log\Parser();
$entries = $logParser->parseLogs($logs);

$calculator = new \Log\Calculator();
$summary = $calculator->calculateSummary($entries, new \Log\Sorter\percentageOfTotalTimeSorter());

$output = new \Log\Output\cliOutput();
$output->printOutput($summary);
``` 
