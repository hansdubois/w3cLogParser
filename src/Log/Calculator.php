<?php
namespace Log;

use Log\Sorter\sorterInterface;

class Calculator
{
    /**
     * @param Entry[] $entries
     */
    public function calculateSummary($entries, sorterInterface $sorter)
    {
        $summary = [
            'Calls' => [],
            'Totals' => [
                'requests' => 0,
                'timeTaken' => 0
            ]
        ];

        foreach ($entries as $entry) {
            $urlSection = $this->getMainSectionOfUri($entry);

            if ($urlSection === '' || $urlSection === 0) {
                continue;
            }

            if (!array_key_exists($urlSection, $summary['Calls'])) {
                $summary['Calls'][$urlSection] = [
                    'section' => $urlSection,
                    'callCount' => [
                        'success' => 0,
                        'failed' => 0,
                        'total' => 0
                    ],
                    'duration' => [
                        'success' => 0,
                        'failed' => 0,
                        'total' => 0
                    ]
                ];
            }

            if (substr($entry->getReturnStatus(), 0, 1) == '2') {
                $summary['Calls'][$urlSection]['callCount']['success']++;
                $summary['Calls'][$urlSection]['duration']['success'] = $summary['Calls'][$urlSection]['duration']['success'] + $entry->getTimeTaken();
            }
            else
            {
                $summary['Calls'][$urlSection]['callCount']['failed']++;
                $summary['Calls'][$urlSection]['duration']['failed'] = $summary['Calls'][$urlSection]['duration']['failed'] + $entry->getTimeTaken();
            }

            $summary['Calls'][$urlSection]['callCount']['total']++;
            $summary['Calls'][$urlSection]['duration']['total'] = $summary['Calls'][$urlSection]['duration']['total'] + $entry->getTimeTaken();
            $summary['Totals']['timeTaken'] = $summary['Totals']['timeTaken'] + $entry->getTimeTaken();
        }

        $summary['Totals']['requests'] = count($entries);

        $return = $this->calculatePercentages($this->calculateAverages($summary));

        return $sorter->sortSummary($return);
    }

    private function calculatePercentages($summary)
    {
        $totalCalls = $summary['Totals']['requests'];
        $totalTimeTaken = $summary['Totals']['timeTaken'];

        foreach ($summary['Calls'] as $section => $metrics) {
            $summary['Calls'][$section]['PercentageOfTotalCalls'] = (($summary['Calls'][$section]['callCount']['total'] / $totalCalls) * 100);
            $summary['Calls'][$section]['PercentageOfTotalTime'] = (($summary['Calls'][$section]['duration']['total'] / $totalTimeTaken) * 100);
        }

        return $summary;
    }

    private function calculateAverages($summary)
    {
        foreach ($summary['Calls'] as $section => $metrics) {
            if ($summary['Calls'][$section]['callCount']['total'] > 0) {
                $summary['Calls'][$section]['Averages']['TimeTaken']['Total'] = ((int)$summary['Calls'][$section]['duration']['total'] / $summary['Calls'][$section]['callCount']['total']);
            }

            if ($summary['Calls'][$section]['callCount']['success'] > 0) {
                $summary['Calls'][$section]['Averages']['TimeTaken']['Success'] = ((int)$summary['Calls'][$section]['duration']['success'] / $summary['Calls'][$section]['callCount']['success']);
            }

            if ($summary['Calls'][$section]['callCount']['failed'] > 0) {
                $summary['Calls'][$section]['Averages']['TimeTaken']['Failed'] = ((int)$summary['Calls'][$section]['duration']['failed'] / $summary['Calls'][$section]['callCount']['failed']);
            }
        }

        if ($summary['Totals']['requests'] > 0) {
            $summary['Averages']['TimeTaken'] = ((int)$summary['Totals']['timeTaken'] / (int)$summary['Totals']['requests']);
        }

        return $summary;
    }

    /**
     * @param Entry $entry
     * @return mixed|string
     */
    private function getMainSectionOfUri(Entry $entry) {
        $uri = $entry->getUri();
        $uri = rtrim($uri, '/');

        if (preg_match('/^\/customers\/\d+\/orders\/\d+$/', $uri)) {
          return 'customer-order (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/customers\/\d+\/orders$/', $uri)) {
          return 'customer-orders (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/customers\/\d+$/', $uri)) {
          return 'customer (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/customers$/', $uri)) {
          return 'customers (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/customers\/\d+\/activemails$/', $uri)) {
          return 'c-activemails (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/customers\/\d+\/activemails\/\d+$/', $uri)) {
          return 'c-activemail (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/customers\/\d+\/complaints$/', $uri)) {
          return 'customer-complaints (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/customers\/\d+\/invoice\/\d+$/', $uri)) {
          return 'customer-invoice (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/customers\/\d+\/credentials$/', $uri)) {
          return 'customer-credentials (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/customers\/\d+\/alias\/.*$/', $uri)) {
          return 'customer-alias (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/simcustomers\/.+$/', $uri)) {
          return 'sim-customer (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/simcustomers$/', $uri)) {
          return 'sim-customers (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/timeslot\/\d+\/\d+\/\d+$/', $uri)) {
          return 'timeslot (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/token$/', $uri)) {
          return 'token (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/activemails$/', $uri)) {
          return 'activemails (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/transactions\/\d+$/', $uri)) {
          return 'transactions (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/orders$/', $uri)) {
          return 'orders (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/health$/', $uri)) {
          return 'health (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/password$/', $uri)) {
          return 'password (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/dropoff\/\d+\/locations$/', $uri)) {
          return 'dropoff-locations (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/dropoff\/\d+\/locations\/.+$/', $uri)) {
          return 'dropoff-locations-postal (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/voucher\/.+$/', $uri)) {
          return 'voucher (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/credentials/', $uri)) {
          return 'credentials (' . $entry->getMethod() . ')';
        }

        if (preg_match('/^\/invitetopay\/.+$/', $uri)) {
          return 'invitetopay (' . $entry->getMethod() . ')';
        }

        if ($uri === '') {
          return '/ (' . $entry->getMethod() . ')';
        }

        if ($uri === 'cs-method') {
          return 'cs-method (' . $entry->getMethod() . ')';
        }

        if ($uri === '/iisconfig') {
          return 'iisconfig (' . $entry->getMethod() . ')';
        }

        return 'other';
    }
}
