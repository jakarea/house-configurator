<?php
/**
 * @package  HouseConfigurator
 */

 if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

    /**
    * Plugin Name:       House Configurator
    * Plugin URI:		http://giopio.com
    * Description:       House Configurator is helping for making house estimate in a minutes.
    * Version:           1.0.0
    */

    /**
     * The code that runs during show success message or error message
     */
    if ( isset( $_GET['message'] ) && $_GET['message'] == 1 ) {
        echo '<div class="notice notice-success is-dismissible">
                <p>Data has been added successfully!</p>
            </div>';
    } else if ( isset( $_GET['message'] ) && $_GET['message'] == 'update' ) {
        echo '<div class="notice notice-success is-dismissible">
                <p>Data has been updated successfully!</p>
            </div>';
    } else if ( isset( $_GET['message'] ) && $_GET['message'] == 'delete' ) {
        echo '<div class="notice notice-success is-dismissible">
                <p>Data has been deleted successfully!</p>
            </div>';
    } else if ( isset( $_GET['message'] ) && $_GET['message'] == 4 ) {
        echo '<div class="notice notice-error is-dismissible">
                <p>Data has been deleted failed!</p>
            </div>';
    }
    
    /**
    * Import level template
    */
    require_once 'levels.php';

    /**
     * import feature template
     */
    require_once 'features.php';