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
        add_shortcode( 'house_configurator_part_one', array( $this, 'houseConfiguratorShortcodeOne' ) );
        add_shortcode( 'house_configurator_part_two', array( $this, 'houseConfiguratorShortcodeTwo' ) );
        add_shortcode( 'house_configurator_part_three', array( $this, 'houseConfiguratorShortcodeThree' ) );
    }

    public function houseConfiguratorShortcodeOne() 
    {
        ob_start();
        require_once( "$this->plugin_path/shortcode/part-one.php" );
        return ob_get_clean();
    }

    public function houseConfiguratorShortcodeTwo() 
    {
        ob_start();
        require_once( "$this->plugin_path/shortcode/part-two.php" );
        return ob_get_clean();
    }

    public function houseConfiguratorShortcodeThree() 
    {
        ob_start();
        require_once( "$this->plugin_path/shortcode/part-three.php" );
        return ob_get_clean();
    }

}