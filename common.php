<?php
error_reporting(E_ERROR);

include __DIR__ . '/vendor/autoload.php';

$jira_host  = '';
$jira_user  = '';
$jira_pwd   = '';

$employees  = array();

$reports    = array();

include __DIR__ . '/data.php';



/**
 * @return chobie\Jira\Api
 */
function getApiClient()
{
	$api = new \chobie\Jira\Api(
	    "https://jira.host",
		new \chobie\Jira\Api\Authentication\Basic("user", "password")
	);

	return $api;
}

function getMonths($year)
{
    $result = array();
    for ($m = 1; $m <=12; $m++)
    {
        $month = date('F', mktime(0,0,0,$m, 1, $year));
        $result[$month] = array(
            'firstDay' => date("Y/m/d",strtotime("first day of $month $year")),
            'lastDay'  => date("Y/m/d",strtotime("last day of $month $year"))
        );
    }
    return $result;
}