<?php
/*
Plugin Name: Drastic Table Manager
Plugin URI: http://wordpress.org/extend/plugins/drastic-table-manager/
Description: AJAX-based manager for WordPress database tables, built using <a href="http://www.drasticdata.nl/DDTools.php">DrasticTools</a>. Accessible from the menu option <a href="edit.php?page=drastic-table-manager/drastic-table-manager.php">Manage &rarr; DB Tables</a>.
Version: 0.4
Author: Jorge Garcia de Bustos
Author URI: http://www.linkedin.com/in/jgbustos
*/

include_once('drastic-consts.php');

if (function_exists('add_action')) {
	add_action('admin_head', 'drasticmgr_add_js_css');
	add_action('admin_menu', 'drasticmgr_add_menu');
}

function drasticmgr_add_js_css() {
	$const = get_defined_constants();
	echo <<<EOT
<link rel="stylesheet" href="{$const['DRASTICTOOLS_URL']}/css/grid_default.css" type="text/css" />

EOT;
}

function drasticmgr_add_menu() {	
	if (function_exists('add_management_page')) {
		global $drasticmgr_texts;
		add_management_page(
			$drasticmgr_texts['Drastic Table Manager'], 
			$drasticmgr_texts['DB Tables'], 
			8, DRASTICMGR_DIR_NAME . '/' . basename(__FILE__), 'drasticmgr_table_view');
	}
}

function drasticmgr_create_table_nonce_key($table) {
	return wp_create_nonce(DRASTICMGR_DIR_NAME . DRASTICMGR_KEY . $table);
}

function drasticmgr_table_view() {
	$drastic_table_name = (isset($_GET['table'])) ? $_GET['table'] : '';
	echo <<<EOT
	<div id="drasticmgr" class="wrap">

EOT;
	drasticmgr_create_table_list_html();
	if ($drastic_table_name) {
		drasticmgr_create_data_grid_html($drastic_table_name);
	}
	echo <<<EOT
	</div>

EOT;
}

function drasticmgr_create_table_list_html() {
	global $wpdb;
	global $table_prefix;
	global $drasticmgr_texts;
	$tables = $wpdb->get_results($wpdb->prepare('show table status where Comment <> %s', 'VIEW'), ARRAY_A);
	echo <<<EOT
	<h2>{$drasticmgr_texts['Table List']}</h2>
	<table class="widefat">
	<thead>
		<tr>
			<th>{$drasticmgr_texts['Table Name']}</th>
			<th>{$drasticmgr_texts['DB Engine']}</th>
			<th class="num">{$drasticmgr_texts['Rows']}</th>
			<th class="num">{$drasticmgr_texts['Data Size']}</th>
			<th class="num">{$drasticmgr_texts['Auto Increment']}</th>
			<th>{$drasticmgr_texts['Creation Time']}</th>
			<th>{$drasticmgr_texts['Collation']}</th>
		</tr>
	</thead>
	<tbody>

EOT;
	foreach ($tables as $table) {
		$table_link = str_replace($table_prefix, '', $table['Name']);
		$record_count = $wpdb->get_results('select count(*) from ' . $table['Name'], ARRAY_N);
		echo <<<EOT
		<tr>
			<td><strong><a class="row-title" href="?page=drastic-table-manager/drastic-table-manager.php&amp;table={$table_link}#grid">{$table['Name']}</a></strong></td>
			<td>{$table['Engine']}</td>
			<td class="num">{$record_count[0][0]}</td>
			<td class="num">{$table['Data_length']}</td>
			<td class="num">{$table['Auto_increment']}</td>
			<td>{$table['Create_time']}</td>
			<td>{$table['Collation']}</td>
		</tr>

EOT;
	}
	echo <<<EOT
	</tbody>
	</table>
EOT;
}

function drasticmgr_create_data_grid_html($table_name) {
	$nonce = drasticmgr_create_table_nonce_key($table_name);
	$const = get_defined_constants();
	global $wpdb;
	global $table_prefix;
	global $drasticmgr_texts;
	$sql = 'show columns from ' . $table_prefix . $wpdb->escape($table_name);
	$columns = $wpdb->get_results($sql, ARRAY_N);
	$column_count = count($columns);	
	echo <<<EOT
	<h2>{$drasticmgr_texts['Table']}: {$table_prefix}{$table_name}</h2>
	<p id="drasticgrid"><a name="grid"></a></p>
	<script type="text/javascript" src="{$const['MOOTOOLS_URL']}/mootools-1.2-core.js"></script>
	<script type="text/javascript" src="{$const['MOOTOOLS_URL']}/mootools-1.2-more.js"></script>
	<script type="text/javascript" src="{$const['DRASTICTOOLS_URL']}/js/drasticGrid.js"></script>
	<script type="text/javascript">
	//<![CDATA[
		var minColWidth = 90;
		var colWidth = (document.getElementById('drasticmgr').clientWidth - 80) / {$column_count};
		colWidth = (colWidth < minColWidth) ? minColWidth : colWidth;
		var options = {
			path: '{$const['DRASTICMGR_URL']}/drastic-table-view.php',
			pathimg: '{$const['DRASTICTOOLS_URL']}/img/',
			colwidth: colWidth,
			pagelength: 20,
			table_name: '{$table_name}',
			key: '{$nonce}'
		}
		var thegrid = new drasticGrid('drasticgrid', options);
	//]]>
	</script>

EOT;
}

?>