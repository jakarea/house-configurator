<?php
/**
 * @package  HouseConfigurator
 */
namespace Inc\Base;

class Activate
{
	public static function activate() {
		flush_rewrite_rules();

		// create a new table for type [name, price]
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$house_type = $wpdb->prefix . 'house_configurator_type';
		$sql = "CREATE TABLE $house_type (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			name tinytext NOT NULL,
			price float NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		// create a new table for feature list [name, price, type_id in array]
		$house_feature = $wpdb->prefix . 'house_configurator_feature';
		$sql2 = "CREATE TABLE $house_feature (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			name tinytext NOT NULL,
			price float NOT NULL,
			type_id tinytext NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql2 );
	}
}