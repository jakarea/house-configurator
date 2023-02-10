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
		// enqueue all our scripts
		wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'assets/mystyle.css' );
		wp_enqueue_script( 'mypluginscript', $this->plugin_url . 'assets/myscript.js' );
	}

	// enqueue scripts frontend
	function enqueue_frontend() {
		// register jquery
		wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '3.3.1', true );
		wp_enqueue_script( 'jquery' );
		// enqueue script
		wp_enqueue_script( 'frontend_scripts', $this->plugin_url . 'assets/frontend.js', array( 'jquery' ), '1.0.0', true );
		// enqueue style
		wp_enqueue_style( 'frontend_style', $this->plugin_url . 'assets/frontend.css' );
		// add bootstrap
		wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
		wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array( 'jquery' ), '4.0.0', true );
	}
}