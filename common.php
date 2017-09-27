<?php
require __DIR__ . '/vendor/autoload.php';

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
