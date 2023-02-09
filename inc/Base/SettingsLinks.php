<?php
/**
 * @package  HouseConfigurator
 */
namespace Inc\Base;

use Inc\Base\BaseController;

class SettingsLinks extends BaseController
{
	public function register() 
	{
		add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
	}

	public function settings_link( $links ) 
	{
		$settings_link = '<a href="admin.php?page=house_configurator">Settings</a>';
		$docs_link = '<a href="https://www.happyarif.com">Support Us</a>';
		array_push( $links, $settings_link );
		array_push( $links, $docs_link );
		return $links;
	}

}