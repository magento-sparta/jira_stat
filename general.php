<?php
require dirname(__FILE__) . '/common.php';

$year   = isset($argv[1]) ? $argv[1] : date("Y");

if (isset($reports['general'])) {
    $result = array();
    $jqls   = array();
    $api    = getApiClient();
    $walker = new \chobie\Jira\Issues\Walker($api);
    foreach ($reports['general'] as $report => $jql) {
        $periods = getWeeks($year);
        foreach ($periods as $key => $days) {
            $result['Period'][$key] = $days['key'];
            $walker->rewind();
            $current_jql = sprintf($jql, $days['firstDay'], $days['lastDay']);
            $walker->push($current_jql);
            $jqls[$report][$key] = $current_jql;
            $result[$report][$key] = $walker->count();
        }
    }
}

std_output($result);
