<?php
include_once('drastic-consts.php');
include_once(JSONWRAPPER_DIR . "/jsonwrapper.php");
require_once(DRASTICTOOLS_DIR . "/drasticSrcMySQL.class.php");

$drasticmgr_grid_options = array (
	"add_allowed" => true,
	"delete_allowed" => true
);

$drastic_table_name = (isset($_GET['tab'])) ? $_GET['tab'] : '';
$drastic_nonce_key = (isset($_GET['key'])) ? $_GET['key'] : '';

function drasticmgr_verify_table_nonce_key() {
	global $drastic_table_name;
	global $drastic_nonce_key;
	if (function_exists('wp_verify_nonce')) {
		return wp_verify_nonce($drastic_nonce_key, 
			DRASTICMGR_DIR_NAME . DRASTICMGR_KEY . $drastic_table_name);
	}
	return false;
}

if (!drasticmgr_verify_table_nonce_key()) {
	die($drasticmgr_texts['No Valid Session']);
}

$drasticmgr_src = new drasticSrcMySQL(
	// DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, $table_prefix all declared in wp-config.php
	DB_HOST, 
	DB_USER, 
	DB_PASSWORD, 
	DB_NAME, 
	$table_prefix . $drastic_table_name, 
	$drasticmgr_grid_options);

?>