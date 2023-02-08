<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package  HouseConfigurator
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// Clear Database table ['house_configurator_type', 'house_configurator_feature']
global $wpdb;
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}house_configurator_type" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}house_configurator_feature" );