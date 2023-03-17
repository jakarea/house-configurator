<?php 
/**
 * @package  HouseConfigurator
 */
namespace Inc\Base;

use Inc\Base\BaseController;

/**
* 
*/
class Enqueue extends BaseController
{
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend' ) );
	}
	
	function enqueue() {
		// Get the current screen object
		$screen = get_current_screen();
		// Check if the current screen is a plugin dashboard page
		if ( strpos( $screen->id, 'house-configurator' ) !== false ) {
		  // enqueue backend scripts
		  wp_enqueue_style( 'hc_backend-css', $this->plugin_url . 'assets/hc_backend.css' );
		  wp_enqueue_script( 'hc_backend-js', $this->plugin_url . 'assets/hc_backend.js' );

		  if ( ! wp_script_is( 'jquery', 'enqueued' ) ) {
			wp_enqueue_script( 'jquery' );
		  }
		//   enqueue cookie script
			wp_enqueue_script( 'jquery-cookie', $this->plugin_url . 'assets/vendor/cookies/cookie.js', array('jquery'), '1.0', true );
		  if ( ! wp_style_is( 'bootstrap', 'enqueued' ) ) {
			wp_enqueue_style( 'bootstrap-css', $this->plugin_url . 'assets/vendor/bootstrap/css/bootstrap.min.css' );
		  }
		  if ( ! wp_script_is( 'bootstrap', 'enqueued' ) ) {
			wp_enqueue_script( 'bootstrap-js', $this->plugin_url . 'assets/vendor/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '4.6.0', true );
		  }
		}
		else {
			wp_enqueue_style( 'hc_mypluginstyle', $this->plugin_url . 'assets/hc_style.css' );
			wp_enqueue_script( 'hc_mypluginscript', $this->plugin_url . 'assets/hc_script.js' );
		}
	}
	  

	// enqueue scripts frontend
	function enqueue_frontend() {
		// register jquery
		wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '3.3.1', true );
		wp_enqueue_script( 'jquery' );
		// enqueue script
		wp_enqueue_script( 'hc_frontend_scripts', $this->plugin_url . 'assets/hc_frontend.js', array( 'jquery' ), '1.0.0', true );
		wp_localize_script( 'hc_frontend_scripts', 'ajax_url', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

		// enqueue style
		wp_enqueue_style( 'hc_frontend_style', $this->plugin_url . 'assets/hc_frontend.css' );
		// add bootstrap
		wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
		wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array( 'jquery' ), '4.0.0', true );
		// add https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css
		wp_enqueue_style( 'smartwizard', 'https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css' );
		wp_enqueue_script( 'smartwizard', 'https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js', array( 'jquery' ), '6.0.0', true );
	}
}