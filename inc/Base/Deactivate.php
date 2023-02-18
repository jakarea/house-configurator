<?php
/**
 * @package  HouseConfigurator
 */
namespace Inc\Base;

class Deactivate
{
	public static function deactivate() {
		flush_rewrite_rules();
		unregister_post_type( 'house-configurator' );
	}
}