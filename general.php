<?php
require dirname(__FILE__) . '/common.php';

$year   = isset($argv[1]) ? $argv[1] : date("Y");

if (isset($reports['general'])) {
    $result = array();
    $jqls   = array();
    $api    = getApiClient();
    $walker = new \chobie\Jira\Issues\Walker($api);
    foreach ($reports['general'] as $report => $jql) {
        $periods = getMonths($year);
        foreach ($periods as $month => $days) {
            $walker->rewind();
            $current_jql = sprintf($jql, $month, $days['firstDay'], $days['lastDay']);
            $walker->push($current_jql);
            $jqls[$report][$month] = $current_jql;
            $result[$report][$month] = $walker->count();
        }
    }
}

var_dump($result);
