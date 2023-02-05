<?php
/**
 * @package  HouseConfigurator
 */

namespace Inc\Base;

use Inc\Base\BaseController;

/**
 * 
 */
class ShortcodeController extends BaseController
{
    public function register() 
    {
        add_shortcode( 'house_configurator', array( $this, 'houseConfiguratorShortcode' ) );
    }

    public function houseConfiguratorShortcode() 
    {
        ob_start();
        require_once( "$this->plugin_path/shortcode/part-one.php" );
        return ob_get_clean();
    }
}