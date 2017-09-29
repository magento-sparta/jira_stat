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
            $result['Month'][$month] = $month;
            $walker->rewind();
            $current_jql = sprintf($jql, $days['firstDay'], $days['lastDay']);
            $walker->push($current_jql);
            $jqls[$report][$month] = $current_jql;
            $result[$report][$month] = $walker->count();
        }
    }
}

std_output($result);
