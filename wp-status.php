<?php
/*
Plugin Name: WP Status
Plugin URI:
Description: Shows WP database status at site.com/?wp-db-status=1
Version: 2014.09.15
Author: khromov
Author URI:
*/

add_filter('query_vars', function($vars)
{
	$vars[] = 'wp-db-status';
	return $vars;
});

add_action('template_redirect', function()
{
	/* @var $wpdb WPDB */
	global $wpdb;

	if(get_query_var('wp-db-status') !== '')
	{
		$uptime_query = $wpdb->get_results("SHOW GLOBAL STATUS LIKE 'Uptime'");
		$load = sys_getloadavg();

		$return = array();
		$return['status'] = 'OK';
		$return['db_uptime'] = (gmdate("z", ($uptime_query[0]->Value)) . ' days, ' . gmdate("H:i", $uptime_query[0]->Value));
		$return['generation_time'] = timer_stop(0, 2);
		$return['load_1m'] = (string)$load[0];
		$return['load_5m'] = (string)$load[1];
		$return['load_15m'] = (string)$load[2];

		header('Content-Type: application/json');
		echo json_encode($return);
		exit();
	}
});