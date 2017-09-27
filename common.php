<?php
require __DIR__ . '/vendor/autoload.php';

$host = "";
$user = "";
$pwd  = "";

/**
 * @return chobie\Jira\Api
 */
function getApiClient()
{
	$api = new \chobie\Jira\Api(
	    $host,
		new \chobie\Jira\Api\Authentication\Basic($user, $pwd)
	);

	return $api;
}
