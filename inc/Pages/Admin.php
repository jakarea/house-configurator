<?php 
/**
 * @package  HouseConfigurator
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
* 
*/
class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $pages = array();

	public $subpages = array();

	public function register() 
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'House Configurator Plugin', 
				'menu_title' => 'House Configurator', 
				'capability' => 'manage_options', 
				'menu_slug' => 'house_configurator', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-store', 
				'position' => 110
			)
		);
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'house_configurator', 
				'page_title' => 'Level Settings', 
				'menu_title' => 'Levels', 
				'capability' => 'manage_options', 
				'menu_slug' => 'house_config_levels', 
				'callback' => array( $this->callbacks, 'adminLevels' )
			),
			array(
				'parent_slug' => 'house_configurator', 
				'page_title' => 'Features Settings', 
				'menu_title' => 'Features', 
				'capability' => 'manage_options', 
				'menu_slug' => 'house_config_features', 
				'callback' => array( $this->callbacks, 'adminFeatures' )
			)
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'house_configurator_options_group',
				'option_name' => 'ds_feet',
				'callback' => array( $this->callbacks, 'alecadddOptionsGroup' )
			),
			array(
				'option_group' => 'house_configurator_options_group',
				'option_name' => 'house_configure_price',
				'callback' => array( $this->callbacks, 'alecadddOptionsGroup' )
			),
			array(
				'option_group' => 'house_configurator_options_group',
				'option_name' => 'house_configure_description',
				'callback' => array( $this->callbacks, 'alecadddOptionsGroup' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'alecaddd_admin_index',
				'title' => 'Settings',
				'callback' => array( $this->callbacks, 'alecadddAdminSection' ),
				'page' => 'house_configurator'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array(
			array(
				'id' => 'ds_feet',
				'title' => 'Default Square Feet',
				'callback' => array( $this->callbacks, 'houseConfigure_ds_feet' ),
				'page' => 'house_configurator',
				'section' => 'alecaddd_admin_index',
				'args' => array(
					'label_for' => 'ds_feet',
					'class' => 'example-class'
				)
			),
			array(
				'id' => 'house_configure_price',
				'title' => 'Per Square Feet Price',
				'callback' => array( $this->callbacks, 'houseConfigure_price' ),
				'page' => 'house_configurator',
				'section' => 'alecaddd_admin_index',
				'args' => array(
					'label_for' => 'house_configure_price',
					'class' => 'example-class'
				)
			),
			array(
				'id' => 'house_configure_description',
				'title' => 'Description',
				'callback' => array( $this->callbacks, 'houseConfigure_description' ),
				'page' => 'house_configurator',
				'section' => 'alecaddd_admin_index',
				'args' => array(
					'label_for' => 'house_configure_description',
					'class' => 'example-class'
				)
			)
		);

		$this->settings->setFields( $args );
	}
}