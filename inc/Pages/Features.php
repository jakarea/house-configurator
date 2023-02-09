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
class Features extends BaseController
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
                'page_title' => 'Features Manage', 
                'menu_title' => 'Features Manage', 
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
                'option_group' => 'house_config_features_settings',
                'option_name' => 'house_config_features',
                'callback' => array( $this->callbacks, 'houseConfigFeaturesSanitize' )
            )
        );

        $this->settings->setSettings( $args );
    }

    public function setSections()
    {
        $args = array(
            array(
                'id' => 'house_config_features_index',
                'title' => 'Features Settings',
                'callback' => array( $this->callbacks, 'houseConfigFeaturesSectionManager' ),
                'page' => 'house_config_features'
            )
        );

        $this->settings->setSections( $args );
    }

    public function setFields()
    {
        $args = array(
            array(
                'id' => 'feature_name',
                'title' => 'Feature Name',
                'callback' => array( $this->callbacks, 'houseConfigFeaturesName' ),
                'page' => 'house_config_features',
                'section' => 'house_config_features_index',
                'args' => array(
                    'label_for' => 'feature_name',
                    'class' => 'example-class'
                )
            ),
            array(
                'id' => 'feature_price',
                'title' => 'Feature Price',
                'callback' => array( $this->callbacks, 'houseConfigFeaturesPrice' ),
                'page' => 'house_config_features',
                'section' => 'house_config_features_index',
                'args' => array(
                    'label_for' => 'feature_price',
                    'class' => 'example-class'
                )
            ),
            array(
                'id' => 'feature_image',
                'title' => 'Feature Image',
                'callback' => array( $this->callbacks, 'houseConfigFeaturesImage' ),
                'page' => 'house_config_features',
                'section' => 'house_config_features_index',
                'args' => array(
                    'label_for' => 'feature_image',
                    'class' => 'example-class'
                )
            )
        );

        $this->settings->setFields( $args );

    }
}