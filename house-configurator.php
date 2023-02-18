<?php
/**
 * @package  HouseConfigurator
 */
/*
Plugin Name: House Configurator
Plugin URI: http://giopio.com
Description: House Configurator is helping for making house estimate in a minutes.
Version: 1.0.0
Author: Giopio
Author URI: http://happyarif.com
License: GPLv2 or later
Text Domain: house-configurator
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}
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
}
register_activation_hook( __FILE__, 'house_configurator_install' );


// include_once function.php
include_once( 'inc/function.php' );

/**
 * The code that runs during plugin activation
 */
function activate_house_configurator() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_house_configurator' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_house_configurator() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_house_configurator' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}