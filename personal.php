<?php
require dirname(__FILE__) . '/common.php';

$year   = isset($argv[1]) ? $argv[1] : date("Y");

if (isset($reports['personal'])) {
    $result = array(array('Name', 'login', 'Role', 'Location', 'Month', 'Project', 'Number'));
    $api    = getApiClient();
    $walker = new \chobie\Jira\Issues\Walker($api);
    foreach ($reports['personal']['accounts'] as $location => $data_loc) {
        foreach ($data_loc as $role => $data_role) {
            foreach ($data_role as $account => $name) {
                foreach ($reports['personal']['reports'] as $project => $jql) {
                    foreach (getMonths($year) as $month => $days) {
                        $current_jql = sprintf($jql, $account, $days['firstDay'], $days['lastDay']);
                        $walker->rewind();
                        $walker->push($current_jql);
                        //var_dump($current_jql);
                        $result[] = array($name, $account, $role, $location, $month, $project, $walker->count());
                    }
                }
            }
        }
        $periods = getMonths($year);

    }
}

std_output($result);
