=== Drastic Table Manager ===
Contributors: jgbustos
Tags: AJAX, admin, database, drastic, table, manager, datagrid, insert, update, delete, records
Requires at least: 2.5
Tested up to: 2.6.1
Stable tag: 0.4

AJAX-based table manager for WordPress. It is built using the excellent data grid
from DrasticTools.

== Description ==

[DrasticTools](http://www.drasticdata.nl/DDTools.php "DrasticTools") is a collection
of PHP and JS scripts that generate AJAX-based data managers and viewers for MySQL
tables. DrasticGrid is a data grid that supports pagination, sorting, insertions, 
deletion and update of records.

The Drastic Table Manager plugin allows WP administrators to manage the MySQL tables
that support WordPress.

== Installation ==

1. Download the `drastic-table-manager.zip` archive.
1. Extract the `drastic-table-manager` directory to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Manage your DB tables using the 'Manage' ==> 'DB Tables' menu option.

== Frequently Asked Questions ==

== Screenshots ==

1. Table list and first page of the 'options' table.

== Changelog ==

= Version 0.4 =

* BUGFIX: Column headers back to normal colour.
* NEW: A wrapper around the PEAR package Services_JSON to remove the JSON support as a requisite.

= Version 0.3 (2008-08-25) =

* NEW: Added POT file for i18n support.
* BUGFIX: Grid slider back on the left side.

= Version 0.2 (2008-08-25) =

* All JavaScript files are now compressed using YUI Compressor 2.3.5.

= Version 0.1 (2008-08-25) =

* First release.
