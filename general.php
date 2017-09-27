<?php
require dirname(__FILE__) . '/common.php';

$year   = isset($argv[1]) ? $argv[1] : date("Y");

if (isset($reports['general'])) {
    $result = array();
    $api = getApiClient();
    $walker = new \chobie\Jira\Issues\Walker($api);
    foreach ($reports['general'] as $report => $jql) {
        foreach (getMonths(2017) as $month => $days) {
            $report = sprintf($report, $month, $days['firstDay'], $days['lastDay']);
            $walker->push($jql);
            $result[$report][$month] = count($walker);
        }
    }
}

var_dump($result);
