<?php

$root = dirname(dirname(dirname(dirname(__FILE__))));
if (file_exists($root . '/wp-load.php')) {
	require_once($root . '/wp-load.php'); // WP 2.6
} else {
	require_once($root . '/wp-config.php'); // Before 2.6
}

if (!defined('WP_CONTENT_DIR')) {
	define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
}
if (!defined('WP_CONTENT_URL')) {
	define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
}
if (!defined('WP_PLUGIN_DIR')) {
	define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');
}
if (!defined('WP_PLUGIN_URL')) {
	define('WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins');
}

// GamerZ and Ozh deserve to go to WP developers' paradise for the code above

if (!defined('DRASTICMGR_DIR_NAME')) {
	define('DRASTICMGR_DIR_NAME', plugin_basename(dirname(__FILE__)));
}
if (!defined('DRASTICMGR_DIR')) {
	define('DRASTICMGR_DIR', WP_PLUGIN_DIR . '/' . DRASTICMGR_DIR_NAME);
}
if (!defined('DRASTICMGR_URL')) {
	define('DRASTICMGR_URL', WP_PLUGIN_URL . '/' . DRASTICMGR_DIR_NAME);
}
if (!defined('MOOTOOLS_URL')) {
	define('MOOTOOLS_URL', DRASTICMGR_URL . '/mootools');
}
if (!defined('JSONWRAPPER_DIR')) {
	define('JSONWRAPPER_DIR', DRASTICMGR_DIR . '/json-wrapper');
}
if (!defined('DRASTICTOOLS_DIR')) {
	define('DRASTICTOOLS_DIR', DRASTICMGR_DIR . '/drastic-tools');
}
if (!defined('DRASTICTOOLS_URL')) {
	define('DRASTICTOOLS_URL', DRASTICMGR_URL . '/drastic-tools');
}

if (!defined('DRASTICMGR_KEY')) {
	switch (true) {
		case defined('AUTH_KEY'): // WP 2.6
			define('DRASTICMGR_KEY', AUTH_KEY);
			break;
		case defined('SECRET_KEY'): // WP 2.5
			define('DRASTICMGR_KEY', SECRET_KEY);
			break;
		default: // Prior to WP 2.5
			define('DRASTICMGR_KEY', DRASTICMGR_DIR_NAME);
			break;
	}
}

$drasticmgr_texts = array(
	'Drastic Table Manager' => __('Drastic Table Manager', 'drasticmgr'),
	'DB Tables' => __('DB Tables', 'drasticmgr'),
	'Table List' => __('Table List', 'drasticmgr'),	
	'Table' => __('Table', 'drasticmgr'),
	'Table Name' => __('Table Name', 'drasticmgr'),
	'DB Engine' => __('DB Engine', 'drasticmgr'),
	'Rows' => __('Rows', 'drasticmgr'),
	'Data Size' => __('Data Size', 'drasticmgr'),
	'Auto Increment' => __('Auto Increment', 'drasticmgr'),
	'Creation Time' => __('Creation Time', 'drasticmgr'),
	'Collation' => __('Collation', 'drasticmgr'),
	'No Valid Session' => __('No Valid Session', 'drasticmgr')
);

?>
