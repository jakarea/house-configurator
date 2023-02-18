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

	// part - 02
	public function adminPartTwo()
	{
		return require_once( "$this->plugin_path/templates/part/2/index.php" );
	}

	public function adminConstructionChoice()
	{
		return require_once( "$this->plugin_path/templates/part/2/construction-choice.php" );
	}

	public function adminConstructionContact()
	{
		return require_once( "$this->plugin_path/templates/part/2/construction-contact.php" );
	}

	public function adminConstructionChoice_2()
	{
		return require_once( "$this->plugin_path/templates/part/2/construction-choice-2.php" );
	}

	// part - 03
	public function adminPartThree()
	{
		ob_clean();
		// redirec to the post-new.php?post_type=house-configurator page using script
		echo '<script>window.location.href = "edit.php?post_type=house-configurator";</script>';

		ob_end_flush();
	}

	public function hcOptionsGroup( $input )
	{
		return $input;
	}

	public function hcAdminSection()
	{
		// give some instruction to admin
		echo 'House Configurator Plugin is a plugin that allows you to configure your house. You can add your house details here.';
	}

	// hcAdminSectionPartOne
	public function hcAdminSectionPartOne()
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

	public function houseConfigure_square_feet_price()
	{
		$value = esc_attr( get_option( 'house_config_house_part_two_price' ) );
		echo '<input type="text" class="regular-text" name="house_config_house_part_two_price" value="' . $value . '" placeholder="Write Price Here!">';
	}
 
}