<?php
/**
 * @package  HouseConfigurator
 */

namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\LevelsCallback;

/**
 * 
 * @package  HouseConfigurator
 */
class LevelsController extends BaseController
{
    public $settings;

    public $callbacks;

    public $subpages = array();

    public $sections = array();

    public $fields = array();

    public function register() 
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new LevelsCallback();

        $this->setSubpages();
        $this->setSections();
        $this->setFields();

        $this->settings->addSubPages( $this->subpages )->register();

        $this->settings->setSections( $this->sections )->setFields( $this->fields )->register();
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
                'callback' => array( $this->callbacks, 'levelsDashboard' )
            )
        );
    }

    public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'house_configurator_plugin_levels_settings',
				'option_name' => 'house_configurator_plugin_levels',
				'callback' => array( $this->callbacks, 'levelSanitize' )
			)
		);

		$this->settings->setSettings( $args );
	}

    public function setSections()
    {
        $this->sections = array(
            array(
                'id' => 'house_configurator_levels_index',
                'title' => 'Levels Manager',
                'callback' => array( $this->callbacks, 'setSectionManager' ),
                'page' => 'house_configurator_levels'
            )
        );
    }

    public function setFields()
    {
        $args = array(
            array(
                'id' => 'post_type',
                'title' => 'Post Type',
                'callback' => array( $this->callbacks, 'textField' ),
                'page' => 'house_configurator_levels',
                'section' => 'house_configurator_levels_index',
                'args' => array(
                    'option_name' => 'house_configurator_plugin_levels',
                    'label_for' => 'post_type',
                    'placeholder' => 'e.g. level',
                    'array' => 'post_type'
                )
            ),
        );

        $this->settings->setFields( $args );
    }
}