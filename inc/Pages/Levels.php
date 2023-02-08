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
 * @package  HouseConfigurator
 */
class Levels extends BaseController
{
    public $settings;

    public $callbacks;

	public $pages = array();

	public $subpages = array();

    public function register() 
    {
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
    }

    public function setSubpages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => 'house_configurator', 
                'page_title' => 'Levels', 
                'menu_title' => 'Levels', 
                'capability' => 'manage_options', 
                'menu_slug' => 'house_config_levels', 
                'callback' => array( $this->callbacks, 'adminLevels' )
            )
        );
    }



    public function setSettings()
    {
        $args = array(
            array(
                'option_group' => 'house_config_levels_settings',
                'option_name' => 'house_config_levels',
                'callback' => array( $this->callbacks, 'levelsSanitize' )
            ),
            array(
                'option_group' => 'house_config_levels_settings',
                'option_name' => 'houseConfigure_level_data',
                'callback' => array( $this->callbacks, 'levelsSanitize' )
            )
        );

        $this->settings->setSettings( $args );
    }

    public function setSections()
    {
        $args = array(
            array(
                'id' => 'house_config_levels_index',
                'title' => 'Live Manager',
                'callback' => array( $this->callbacks, 'LevelsAdminSection' ),
                'page' => 'house_config_levels'
            )
        );

        $this->settings->setSections( $args );
    }

    public function setFields()
    {

        // insert the field name and price in array data
        $args = array(
            array(
                'id' => 'level_name',
                'title' => 'Level Name',
                'callback' => array( $this->callbacks, 'houseConfigure_level_data' ),
                'page' => 'house_config_levels',
                'section' => 'house_config_levels_index',
                'args' => array(
                    'label_for' => 'level_name',
                    'class' => 'example-class'
                )
            ),
            array(
                'id' => 'level_price',
                'title' => 'Level Price',
                'callback' => array( $this->callbacks, 'houseConfigure_level_data' ),
                'page' => 'house_config_levels',
                'section' => 'house_config_levels_index',
                'args' => array(
                    'label_for' => 'level_price',
                    'class' => 'example-class'
                )
            )
        );


        $this->settings->setFields( $args );
    }
}