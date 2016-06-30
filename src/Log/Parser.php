<?php
namespace Log;

class Parser
{
    public function parseLogs($logs) {
        $logEntries = [];


        foreach ($logs as $logLocation) {
            print("Starting parsing log: " . $logLocation . PHP_EOL);

            // Open File.
            $handle = fopen($logLocation, "r");

            if (!$handle) {
                exit("Cannot open the log file.");
            }

            while($line = fgets($handle)) {
                $entry = explode(" ", $line);

                $logEntry = new Entry();
                $logEntry->fromArray($entry);

                array_push($logEntries, $logEntry);
            }

            fclose($handle);
        }

        return $logEntries;
    }
}