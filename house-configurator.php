<?php
/**
 * Plugin Name:       House Configurator
 * Plugin URI:        https://giopio.com
 * Description:       This is a house configurator plugin for calculating the price of a house.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            GioPio
 * Author URI:        https://giopio.com
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       house-configurator
 * Domain Path:       /languages
 */

/* If this file is called firectly, abort!!! */
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

use Inc\Base\Activate;
use Inc\Base\Deactivate;
use Inc\Init;

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Init::register_services();
}

/**
 * The code that runs during plugin activation
 */
function activate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/Base/Activate.php';
	Activate::activate();
}

/**
 * The code that runs during plugin deactivation
 */
function deactivate_house_configurator() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/Base/Deactivate.php';
	Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_house_configurator' );

/**
 * Text Domain
 */
function house_configurator_load_textdomain() {
	load_plugin_textdomain( 'house-configurator', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'house_configurator_load_textdomain' );

/**
 * Create table when plugin is activated
 */
function house_configurator_install() {
	// create table table for part 2 - part 2 with json data
	global $wpdb;
	$table_name = $wpdb->prefix . 'house_configurator_part_2';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name tinytext NOT NULL,
		value json NOT NULL,
		created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		updated_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	// create a new table for type [name, price]
	$charset_collateh = $wpdb->get_charset_collate();
	$house_type = $wpdb->prefix . 'house_configurator_type';
	$sql1 = "CREATE TABLE $house_type (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name tinytext NOT NULL,
		price float NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collateh;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql1 );

	// create a new table for feature list [name, price, type_id in array]
	$charset_collatef = $wpdb->get_charset_collate();
	$house_feature = $wpdb->prefix . 'house_configurator_feature';
	$sql2 = "CREATE TABLE $house_feature (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name tinytext NOT NULL,
		price float NOT NULL,
		type_id tinytext NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collatef;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql2 );
}
register_activation_hook( __FILE__, 'house_configurator_install' );


/*
* register function for all custom action.
*/
include_once( 'inc/function.php' );
