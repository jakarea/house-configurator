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

// unset post type ['house-configurator']
$posts = get_posts( array( 'post_type' => 'house-configurator', 'numberposts' => -1 ) );

foreach ( $posts as $post ) {
	wp_delete_post( $post->ID, true );
}
// uregister post type ['house-configurator']
unregister_post_type( 'house-configurator' );