<?php 
/**
 * @package  HouseConfigurator
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

	// part - 01
	public function adminPartOne()
	{
		return require_once( "$this->plugin_path/templates/part/1/index.php" );
	}

	public function adminLevels()
	{
		return require_once( "$this->plugin_path/templates/part/1/levels.php" );
	}

	public function adminFeatures()
	{
		return require_once( "$this->plugin_path/templates/part/1/features.php" );
	}

	public function alecadddOptionsGroup( $input )
	{
		return $input;
	}

	public function alecadddAdminSection()
	{
		// give some instruction to admin
		echo 'House Configurator Plugin is a plugin that allows you to configure your house. You can add your house details here.';
	}

	public function LevelsAdminSection()
	{
		// give some instruction to admin
		echo 'House Configurator Plugin is a plugin that allows you to configure your house. You can add your house details here.';
	}

	public function houseConfigure_ds_feet()
	{
		$value = esc_attr( get_option( 'ds_feet' ) );
		echo '<input type="text" class="regular-text" name="ds_feet" value="' . $value . '" placeholder="Write Something Here!">';
	}

	public function houseConfigure_price()
	{
		$value = esc_attr( get_option( 'house_configure_price' ) );
		echo '<input type="text" class="regular-text" name="house_configure_price" value="' . $value . '" placeholder="Write Price Here!">';
	}

	public function houseConfigure_description()
	{
		$value = esc_attr( get_option( 'house_configure_description' ) );
		echo '<textarea class="regular-text" name="house_configure_description" placeholder="Write your description" rows="5" col="5">' . $value . '</textarea>';
	}

	// store level name and price in array and save it in database as meta data json
	public function houseConfigure_level_data()
	{
		$value = array (
			'level_name' => esc_attr( get_option( 'house_configure_level_name' ) ),
			'level_price' => esc_attr( get_option( 'house_configure_level_price' ) )
		);

		foreach ($value as $key => $val) {
			echo '<input type="text" class="regular-text" name="' . $key . '" value="' . $val . '" placeholder="Write ' . $key . ' Here!">';
		}		
		
	}
 
}